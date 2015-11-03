SELECT awk.afm as AFM, awk.name as NAME, SUM(awk.amount) as AMNT, COUNT(awk.amount) as CCOUNT, AVG(awk.amount) as AAVG
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada and dc.organizationId=99206915
GROUP BY awk.afm
ORDER BY AMNT DESC