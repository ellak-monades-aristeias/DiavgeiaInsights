SELECT cpd.cpd_cpv, awk.amount as AMNT, COUNT(awk.amount) as CCOUNT, AVG(awk.amount ) as AAVG, MONTH(dc.issueDate), YEAR(dc.issueDate)
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_ada=dc.ada AND dc.organizationId=99206915 AND cpd.cpd_cpv LIKE '31000000-6'
GROUP BY YEAR(dc.issueDate), MONTH(dc.issueDate)
ORDER BY YEAR(dc.issueDate), MONTH(dc.issueDate)