SELECT SUM(amount) as ammnt, COUNT(amount) as cnt, afm, name
FROM amountwithkae
GROUP BY afm
ORDER BY ammnt DESC
