SELECT COUNT(dc.organizationId), dc.organizationId, org.label
FROM diavgeiainsights.decisions as dc, organisations as org
WHERE org.uid=dc.organizationId