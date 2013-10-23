from random import shuffle

def cakeOrder():
	names = ["Teodor", "Sigurd", "Marius R", "Kristian", "Erling", 
		"Sindre", "Herman", "Ivar", "Thormod", "Andrea Marie", "Kevin",
		"Oda", "Sigurd", "Marius E"]
	weeks = range(42, 49)+range(3,10)
	shuffle(names)
	return [str(w).rjust(2)+": "+n for (w,n) in zip(weeks, names)]

if __name__ == "__main__":
	print "\n".join(cakeOrder())
