SELECT cpv.cpv_label as LBL, ROUND(SUM(sp.amount), 2) as AMNT, COUNT(sp.amount) as CCOUNT, ROUND(AVG(sp.amount), 2) as AAVG, YEAR(dc.issueDate) as ETOS
FROM decisions as dc, decisionsb21 as db21, sponsor as sp, cpv
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada AND sp.cpv=cpv.uid AND dc.organizationId=99206915
GROUP BY LBL, YEAR(dc.issueDate)
ORDER BY LBL, YEAR(dc.issueDate)