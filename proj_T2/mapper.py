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
        length = len(data[4])
        count = data[4].count('"', 0, length)
        if count != 0:
            length -= count/2 + 1
        node_type = data[5]
        if node_type == "question":
            qid = data[0]
            print "{0}\t{1}".format(qid, -length)
        elif node_type == "answer":
            qid = data[6]
            print "{0}\t{1}".format(qid, length)
