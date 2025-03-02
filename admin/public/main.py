

#match

rcb = int(input("Enter RCB Win Ernls :- "))
mi = int(input("Enter Mi Win Ernls :- "))


#fix prize to enrl in contest 

enrl_prize = 100

#enrls

count_enrls = rcb+mi;

# count Win Prize based on enrls

count_prize = count_enrls*enrl_prize
print("Total Enrls Amounts :-",count_prize)

win_prize = count_prize - (count_prize * 10 / 100)
print("In This Contest Winning Prize Is :- ",win_prize)

