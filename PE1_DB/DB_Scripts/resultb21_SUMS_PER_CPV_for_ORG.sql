SELECT cpv.cpv_label as CPV, ROUND(SUM(sp.amount), 2) as ΠΟΣΟ, COUNT(sp.amount) as ΠΛΗΘΟΣ, ROUND(AVG(sp.amount), 2) as ΜΟ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp, cpv
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada and cpv.uid=sp.cpv AND dc.organizationId=99206915
GROUP BY cpv.uid
ORDER BY ΠΟΣΟ DESC