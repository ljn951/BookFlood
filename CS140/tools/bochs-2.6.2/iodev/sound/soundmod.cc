/////////////////////////////////////////////////////////////////////////
// $Id: soundmod.cc 11214 2012-06-09 10:12:05Z vruppert $
/////////////////////////////////////////////////////////////////////////
//
//  Copyright (C) 2011-2012  The Bochs Project
//
//  This library is free software; you can redistribute it and/or
//  modify it under the terms of the GNU Lesser General Public
//  License as published by the Free Software Foundation; either
//  version 2 of the License, or (at your option) any later version.
//
//  This library is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
//  Lesser General Public License for more details.
//
//  You should have received a copy of the GNU Lesser General Public
//  License along with this library; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301 USA

// Common sound module code and dummy sound lowlevel functions

// Define BX_PLUGGABLE in files that can be compiled into plugins.  For
// platforms that require a special tag on exported symbols, BX_PLUGGABLE
// is used to know when we are exporting symbols and when we are importing.
#define BX_PLUGGABLE

#include "iodev.h"

#if BX_SUPPORT_SOUNDLOW

#include "soundmod.h"
#include "soundlnx.h"
#include "soundosx.h"
#include "soundwin.h"
#include "soundsdl.h"

#ifndef WIN32
#include <pthread.h>
#endif
#if BX_WITH_SDL
#include <SDL.h>
#endif

#define LOG_THIS theSoundModCtl->

bx_soundmod_ctl_c* theSoundModCtl = NULL;

int libsoundmod_LTX_plugin_init(plugin_t *plugin, plugintype_t type, int argc, char *argv[])
{
  if (type == PLUGTYPE_CORE) {
    theSoundModCtl = new bx_soundmod_ctl_c;
    bx_devices.pluginSoundModCtl = theSoundModCtl;
    return 0; // Success
  } else {
    return -1;
  }
}

void libsoundmod_LTX_plugin_fini(void)
{
  delete theSoundModCtl;
}

bx_soundmod_ctl_c::bx_soundmod_ctl_c()
{
  put("sound", "SOUND");
  soundmod = NULL;
}

void* bx_soundmod_ctl_c::init_module(const char *type, logfunctions *device)
{
  if (!strcmp(type, "default")) {
    soundmod = new BX_SOUND_LOWLEVEL_C(device);
#if BX_WITH_SDL
  } else if (!strcmp(type, "sdl")) {
    soundmod = new bx_sound_sdl_c(device);
#endif
  } else if (!strcmp(type, "dummy")) {
    soundmod = new bx_sound_lowlevel_c(device);
  } else {
    BX_PANIC(("unknown sound module type '%s'", type));
  }
  return soundmod;
}

#ifndef WIN32
pthread_t thread;
#endif
Bit8u *beep_buffer;
int beep_bytes, beep_bufsize;
bx_bool beep_active = 0;

#ifdef WIN32
DWORD WINAPI beep_thread(LPVOID indata)
#else
void beep_thread(void *indata)
#endif
{
  Bit8u level;
  int i, j;

  beep_active = 1;
  bx_sound_lowlevel_c *soundmod = (bx_sound_lowlevel_c*)indata;
  level = 0x40;
  i = 0;
  while (beep_bytes > 0) {
    j = 0;
    do {
      beep_buffer[j++] = level;
      if ((++i % beep_bytes) == 0) level ^= 0x40;
    } while (j < beep_bufsize);
    soundmod->sendwavepacket(beep_bufsize, beep_buffer);
    if (soundmod->get_type() == BX_SOUNDLOW_WIN) {
#ifdef WIN32
      Sleep(100);
#endif
    } else if (soundmod->get_type() == BX_SOUNDLOW_SDL) {
#if BX_WITH_SDL
      SDL_Delay(100);
#endif
    }
  }
  soundmod->stopwaveplayback();
  free(beep_buffer);
  beep_active = 0;
#ifdef WIN32
  return 0;
#else
  pthread_exit(NULL);
#endif
}

bx_bool bx_soundmod_ctl_c::beep_on(float frequency)
{
  if (soundmod != NULL) {
    BX_DEBUG(("Beep ON (frequency=%.2f)",frequency));
    if (!beep_active) {
      soundmod->startwaveplayback(44100, 8, 0, 0);
      beep_bytes = (int)(44100.0 / frequency / 2);
      beep_bufsize = 4410;
      beep_buffer = (Bit8u*)malloc(beep_bufsize);
#ifdef WIN32
      DWORD threadID;
      CreateThread(NULL, 0, beep_thread, soundmod, 0, &threadID);
#else
      pthread_create(&thread, NULL, (void *(*)(void *))&beep_thread, soundmod);
#endif
    }
    return 1;
  }
  return 0;
}

bx_bool bx_soundmod_ctl_c::beep_off()
{
  if (soundmod != NULL) {
    BX_DEBUG(("Beep OFF"));
    if (beep_active) {
      beep_bytes = 0;
#ifdef WIN32
      while (beep_active) Sleep(1);
#else
      pthread_join(thread, NULL);
#endif
    }
    return 1;
  }
  return 0;
}

// The dummy sound lowlevel functions. They don't do anything.
bx_sound_lowlevel_c::bx_sound_lowlevel_c(logfunctions *dev)
{
  device = dev;
  record_timer_index = BX_NULL_TIMER_HANDLE;
}

bx_sound_lowlevel_c::~bx_sound_lowlevel_c()
{
}

int bx_sound_lowlevel_c::waveready()
{
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::midiready()
{
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::openmidioutput(const char *mididev)
{
  UNUSED(mididev);
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::sendmidicommand(int delta, int command, int length, Bit8u data[])
{
  UNUSED(delta);
  UNUSED(command);
  UNUSED(length);
  UNUSED(data);
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::closemidioutput()
{
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::openwaveoutput(const char *wavedev)
{
  UNUSED(wavedev);
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::startwaveplayback(int frequency, int bits, bx_bool stereo, int format)
{
  UNUSED(frequency);
  UNUSED(bits);
  UNUSED(stereo);
  UNUSED(format);
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::sendwavepacket(int length, Bit8u data[])
{
  UNUSED(length);
  UNUSED(data);
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::stopwaveplayback()
{
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::closewaveoutput()
{
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::openwaveinput(const char *wavedev, sound_record_handler_t rh)
{
  UNUSED(wavedev);
  record_handler = rh;
  if (rh != NULL) {
    record_timer_index = bx_pc_system.register_timer(this, record_timer_handler, 1, 1, 0, "soundmod");
    // record timer: inactive, continuous, frequency variable
  }
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::startwaverecord(int frequency, int bits, bx_bool stereo, int format)
{
  Bit64u timer_val;
  Bit8u shift = 0;

  UNUSED(format);
  if (record_timer_index != BX_NULL_TIMER_HANDLE) {
    if (bits == 16) shift++;
    if (stereo) shift++;
    record_packet_size = (frequency / 10) << shift; // 0.1 sec
    if (record_packet_size > BX_SOUNDLOW_WAVEPACKETSIZE) {
      record_packet_size = BX_SOUNDLOW_WAVEPACKETSIZE;
    }
    timer_val = (Bit64u)record_packet_size * 1000000 / (frequency << shift);
    bx_pc_system.activate_timer(record_timer_index, (Bit32u)timer_val, 1);
  }
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::getwavepacket(int length, Bit8u data[])
{
  memset(data, 0, length);
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::stopwaverecord()
{
  if (record_timer_index != BX_NULL_TIMER_HANDLE) {
    bx_pc_system.deactivate_timer(record_timer_index);
  }
  return BX_SOUNDLOW_OK;
}

int bx_sound_lowlevel_c::closewaveinput()
{
  stopwaverecord();
  return BX_SOUNDLOW_OK;
}

void bx_sound_lowlevel_c::record_timer_handler(void *this_ptr)
{
  bx_sound_lowlevel_c *class_ptr = (bx_sound_lowlevel_c *) this_ptr;

  class_ptr->record_timer();
}

void bx_sound_lowlevel_c::record_timer(void)
{
  record_handler(this->device, record_packet_size);
}

#endif
