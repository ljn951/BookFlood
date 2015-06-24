#!/usr/bin/python

import sys

fre = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
oldKey = None

for line in sys.stdin:
    data = line.strip().split("\t")
    if len(data) == 2:
        thisKey, thisHour = data

        if oldKey and oldKey != thisKey:
            M = max(fre)
            for k in range(0,24):
                if(fre[k] == M):
                    print oldKey, "\t", k
            fre = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
            oldKey = thisKey

        oldKey = thisKey
        fre[int(thisHour)] += 1

if oldKey != None:
    M = max(fre)
    for k in range(0,24):
        if(fre[k] == M):
            print oldKey, "\t", k
