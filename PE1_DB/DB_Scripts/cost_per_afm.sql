SELECT awk.afm as ΑΦΜ, awk.name as ΕΠΩΝΥΜΙΑ, ROUND(SUM(awk.amount), 2) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, ROUNTDAVG(awk.amount), 2) as ΜΟ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada and dc.organizationId=99206915
GROUP BY awk.afm
ORDER BY AMNT DESC