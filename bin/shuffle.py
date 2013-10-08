import sys
from random import randint

def randomized_order(names):
    randomized = []
    while (names):
        index = randint(0, len(names)-1)
        item = names.pop(index)
        randomized.append(item)
    return randomized


def main():
    week_number_start = 42
    names = ["Teodor", "Sigurd", "Marius R", "Kristian", "Erling", 
        "Sindre", "Herman", "Ivar", "Thormod", "Andrea Marie", "Kevin",
        "Oda", "Sigurd", "Marius E"]
    randomized = randomized_order(names)
    randomized_numbered = []
    for i in xrange(len(randomized)):
        week_number = week_number_start + i
        if (week_number > 48):
            week_number -= 46
        randomized_numbered.append((week_number, randomized[i]))
    return randomized_numbered

if __name__ == "__main__":
    result = main()
    if (result):
        print(result)
