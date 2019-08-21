L - Liskov Substituion Principle

-----

<blockquote style="text-align: left">
<small>Subtype Requirement:</small>

Let ϕ ( x ) be a property provable about objects x of type T. Then ϕ ( y ) should be true for objects y of type S where S is a subtype of T.
<br>
&mdash; Barbara Liskov and Jeanette Wing
</blockquote>

Notes:
Φ = phi / phy  (FI as in WI-FI)


----

English please

-----

Objects in a program should be replaceable with instances of their subtypes without 
altering the correctness of that program.

A payment class should process a payment, nothing more, nothing less.