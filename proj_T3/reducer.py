#!/usr/bin/python

import sys

oldKey = None
Top10 = {}
count = 0

for line in sys.stdin:
    if oldKey != line[:-1]:
        if len(Top10) < 10:
            Top10[oldKey] = count
        else:
            k = Top10.keys()[0]
            for i in Top10:
                if Top10[i] <= Top10[k]:
                    k = i
            if count > Top10[k]:
                Top10.pop(k)
                Top10[oldKey] = count
        oldKey = line[:-1]
        count = 0

    oldKey = line[:-1]
    count += 1

if oldKey != None:
    if len(Top10) < 10:
        Top10[oldKey] = count
    else:
        k = Top10.keys()[0]
        for i in Top10:
            if Top10[i] <= Top10[k]:
                k = i
        if count > Top10[k]:
            Top10.pop(k)
    Top10 = sorted(Top10.iteritems(), key = lambda asd:asd[1], reverse = True)
    for i in Top10:
        print i[0], "\t", i[1]
