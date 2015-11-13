SELECT SUM(amk.amount) as ΠΟΣΟ, COUNT(amk.amount) as ΠΛΗΘΟΣ , org.label as ΟΡΓΑΝΙΣΜΟΣ, amk.afm as ΑΦΜ, amk.name as ΟΝΟΜΑ
FROM diavgeiainsights.decisions as dc, organisations as org, amountwithkae as amk
WHERE org.uid=dc.organizationId and amk.awk_ada=dc.ada  and dc.decisionTypeId LIKE 'Β.2.1' and org.uid=6125
GROUP BY amk.afmretailer_holidays