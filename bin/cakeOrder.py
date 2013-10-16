from random import shuffle

def cakeOrder():
	names = ["Teodor", "Sigurd", "Marius R", "Kristian", "Erling", 
		"Sindre", "Herman", "Ivar", "Thormod", "Andrea Marie", "Kevin",
		"Oda", "Sigurd", "Marius E"]
	weeks = map(str,range(42, 49))+map(lambda x : " " + str(x), range(3,10))
	shuffle(names)
	return [str(a).rjust(2)+": "+b for a,b in zip(weeks, names)]

if __name__ == "__main__":
	print "\n".join(cakeOrder())
