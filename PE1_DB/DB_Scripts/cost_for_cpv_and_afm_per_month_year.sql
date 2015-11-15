SELECT awk.afm as AFM, awk.name as NAME, SUM(awk.amount) as AMNT, COUNT(awk.amount) as CCOUNT, AVG(awk.amount ) as AAVG, YEAR(dc.issueDate) as LBL
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_ada=dc.ada AND dc.organizationId=99206915 AND cpd.cpd_cpv LIKE '30200000-1'
GROUP BY AFM, YEAR(dc.issueDate)
ORDER BY AFM, YEAR(dc.issueDate)