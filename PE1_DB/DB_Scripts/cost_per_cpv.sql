SELECT cpv.cpv_label, SUM(awk.amount) as AMNT, COUNT(awk.amount) as CCOUNT, AVG(awk.amount) as AAVG
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd, cpv
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_ada=dc.ada AND dc.organizationId=99206915 and cpv.uid=cpd.cpd_cpv
GROUP BY cpv.uid
ORDER BY AMNT DESC
