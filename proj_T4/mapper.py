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
            group = data[0]
            author_id = data[3]
            print "{0}\t{1}".format(group, author_id)
        else:
            group = data[6]
            author_id = data[3]
            print "{0}\t{1}".format(group, author_id)
