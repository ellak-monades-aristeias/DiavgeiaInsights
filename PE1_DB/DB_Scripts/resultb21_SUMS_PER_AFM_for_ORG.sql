SELECT sp.afm as ΑΦΜ, sp.name as ΕΠΩΝΥΜΙΑ, ROUND(SUM(sp.amount), 2) as ΠΟΣΟ, COUNT(sp.amount) as ΠΛΗΘΟΣ, ROUND(AVG(sp.amount), 2) as ΜΟ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada and dc.organizationId=99206915 
GROUP BY sp.afm
ORDER BY ΠΟΣΟ DESC 