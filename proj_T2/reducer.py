#!/usr/bin/python

import sys

oldKey = None
QL = 0
AL = 0
AC = 0

for line in sys.stdin:
    data = line.strip().split("\t")
    if len(data) == 2:
        thisID, thisLength = data
        if oldKey and oldKey != thisID:
            if AC == 0:
                print oldKey, "\t", QL, "\t", 0
            else:
                print oldKey, "\t", QL, "\t", float(AL)/float(AC)
            oldKey = thisID
            QL = 0
            AL = 0
            AC = 0

    oldKey = thisID
    if int(thisLength) > 0:
        AL += int(thisLength)
        AC += 1
    else:
        QL -= int(thisLength)

if oldKey != None:
    if AC == 0:
        print oldKey, "\t", QL, "\t", 0
    else:
        print oldKey, "\t", QL, "\t", float(AL)/float(AC)
    oldKey = thisID
    QL = 0
    AL = 0
