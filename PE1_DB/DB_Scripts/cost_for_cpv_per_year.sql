SELECT cpv.cpv_label as LBL, SUM(awk.amount) as AMNT, COUNT(awk.amount) as CCOUNT, AVG(awk.amount ) as AAVG, YEAR(dc.issueDate) as ETOS
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd, cpv
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_cpv=cpv.uid AND cpd.cpd_ada=dc.ada AND dc.organizationId=99206915 AND cpd.cpd_cpv LIKE '90911200-8' 
GROUP BY YEAR(dc.issueDate)
ORDER BY YEAR(dc.issueDate)