SELECT cpv.cpv_label as CPV, ROUND(SUM(sp.amount), 2) as ΠΟΣΟ, ROUND(COUNT(sp.amount), 2) as ΠΛΗΘΟΣ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp, cpv
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada AND cpv.uid=sp.cpv AND dc.organizationId=99206915 AND sp.afm LIKE '094180805'
GROUP by CPV