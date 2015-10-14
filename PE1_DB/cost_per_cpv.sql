SELECT cpd.cpd_cpv, SUM(awk.amount) as AMNT, COUNT(awk.amount) as CCOUNT, AVG(awk.amount) as AAVG
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_ada=dc.ada AND dc.organizationId=99206915
GROUP BY cpd.cpd_cpv
ORDER BY AMNT DESC