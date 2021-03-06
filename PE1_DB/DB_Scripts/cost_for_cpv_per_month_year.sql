SELECT SUM(sp.amount) as AMNT, COUNT(sp.amount) as CCOUNT, AVG(sp.amount ) as AAVG, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as TIMEORDER, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as LBL
FROM decisions as dc, decisionsb21 as db21, sponsor as sp
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada AND dc.organizationId=99206915 AND sp.cpv LIKE '90911200-8'
GROUP BY YEAR(dc.issueDate)
ORDER BY YEAR(dc.issueDate)