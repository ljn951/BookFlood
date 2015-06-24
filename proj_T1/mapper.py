#!/usr/bin/python

import sys

first = True
record = ""

for line in sys.stdin:
    if first:
        first = False
        continue

    record += line
    data = record.strip().split("\t")
    if len(data) == 19:
        record = ""
        author_id = data[3]
        add_at = data[8]
        temp1 = add_at.split(" ")
        time = temp1[1]
        temp2 = time.split(":")
        hour = temp2[0]
        print "{0}\t{1}".format(author_id, hour)
