#!/usr/bin/python

import sys

oldKey = None
group = []

for line in sys.stdin:
    data = line.strip().split("\t")
    if len(data) == 2:
        thisKey, thisID = data
        if oldKey and oldKey != thisKey:
            print oldKey, "\t", group
            group = []
            oldKey = thisKey
        
        oldKey = thisKey
        group.append(thisID)


if oldKey != None:
    print oldKey, "\t", group
