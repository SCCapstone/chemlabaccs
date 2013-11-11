SELECT a.id, a.`date`, a.`time`, buildings.name, a.room, a.description, a.severity, a.root, a.prevention, users.email, a.created
FROM accidents a
JOIN buildings ON a.building = buildings.id
JOIN users ON a.user = users.id
LEFT JOIN accidents b ON (a.revision_of = b.revision_of AND a.id < b.id)
WHERE b.id IS NULL