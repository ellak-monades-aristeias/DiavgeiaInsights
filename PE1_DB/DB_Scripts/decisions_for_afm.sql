SELECT dc.ada as ΑΔΑ, dc.subject as ΘΕΜΑ, cpv.cpv_label as CPV, ROUND(sp.amount, 2) as ΠΟΣΟ, dc.issueDate as ΗΜΕΡΟΜΗΝΙΑ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp, cpv
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada AND cpv.uid=sp.cpv AND dc.organizationId=99206915 AND sp.afm LIKE '094019245'
ORDER BY ΗΜΕΡΟΜΗΝΙΑ