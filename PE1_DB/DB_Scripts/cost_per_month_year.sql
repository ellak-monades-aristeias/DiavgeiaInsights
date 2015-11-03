SELECT SUM(awk.amount) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, AVG(awk.amount ) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as ΣΕΙΡΑ, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada and dc.organizationId=99206915
GROUP BY MONTH(dc.issueDate), YEAR(dc.issueDate)
ORDER BY YEAR(dc.issueDate), MONTH(dc.issueDate)