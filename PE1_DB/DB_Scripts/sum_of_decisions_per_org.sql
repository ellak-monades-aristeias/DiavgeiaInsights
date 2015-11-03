SELECT SUM(amk.amount), dc.organizationId, org.label
FROM diavgeiainsights.decisions as dc, organisations as org, amountwithkae as amk
WHERE org.uid=dc.organizationId and amk.awk_ada=dc.ada  and dc.decisionTypeId LIKE 'Β.2.1'
GROUP BY dc.organizationId