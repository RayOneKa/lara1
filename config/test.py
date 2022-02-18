from turtle import *
from random import randint

speed(0)

colormode(255)

for i in range(0, 18):
    r = randint(0, 255)
    g = randint(0, 255)
    b = randint(0, 255)
    color((r, g, b))
    begin_fill()
    for j in range(0, 4):
        forward(100)
        right(90)
    right(20)
    end_fill()

exitonclick()