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
        node_type = data[5]
        if node_type == "question":
            tagname = data[2]
            tag = tagname.split(" ")
            tag = set(tag)
            for t in tag:
                if t:
                    print "{0}".format(t)
