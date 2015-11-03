SELECT * 
FROM amountwithkae, decisions
WHERE decisions.ada=amountwithkae.awk_ada and decisions.decisionTypeId LIKE 'Β.2.1' and decisions.organizationId=6045
