SET NAMES utf8mb4;

INSERT INTO flavors (name, description) VALUES
    ('Bergamot', 'Citrusová aróma s jemne kvetinovým tónom.'),
    ('Vanilka', 'Sladká, jemná aróma.'),
    ('Mäta', 'Svieža bylinná chuť.'),
    ('Jazmín', 'Jemná kvetinová aróma.'),
    ('Malina', 'Ovocná chuť s príjemnou kyslosťou.'),
    ('Jahoda', 'Sladká ovocná aróma.'),
    ('Citrón', 'Svieža a kyslastá citrusová chuť.'),
    ('Zázvor', 'Výrazný, jemne štipľavý tón.'),
    ('Škorica', 'Sladkastá korenistá vôňa.'),
    ('Pomaranč', 'Sladká citrusová aróma.'),
    ('Jablko', 'Jemná ovocná chuť.'),
    ('Ibištek', 'Výrazná kyslastá chuť a sýta farba nálevu.'),
    ('Medovka', 'Jemná bylinná vôňa s citrusovým tónom.'),
    ('Levanduľa', 'Výrazná kvetinová aróma.')
ON DUPLICATE KEY UPDATE id = flavors.id;

INSERT INTO tea_flavors (tea_id, flavor_id)
SELECT t.id, f.id
FROM (
    SELECT 'Earl Grey' AS tea_name, 'Bergamot' AS flavor_name
    UNION ALL SELECT 'Rooibos vanilka', 'Vanilka'
    UNION ALL SELECT 'Mätový čaj', 'Mäta'
    UNION ALL SELECT 'Jazmínový čaj', 'Jazmín'
    UNION ALL SELECT 'Lesné ovocie', 'Malina'
    UNION ALL SELECT 'Lesné ovocie', 'Jahoda'
    UNION ALL SELECT 'Lesné ovocie', 'Ibištek'
    UNION ALL SELECT 'Zelený čaj s mätou a citrónom', 'Mäta'
    UNION ALL SELECT 'Zelený čaj s mätou a citrónom', 'Citrón'
    UNION ALL SELECT 'Zázvorový citrón', 'Zázvor'
    UNION ALL SELECT 'Zázvorový citrón', 'Citrón'
    UNION ALL SELECT 'Zimné jablko', 'Jablko'
    UNION ALL SELECT 'Zimné jablko', 'Škorica'
    UNION ALL SELECT 'Zimné jablko', 'Pomaranč'
    UNION ALL SELECT 'Rooibos pomaranč a vanilka', 'Pomaranč'
    UNION ALL SELECT 'Rooibos pomaranč a vanilka', 'Vanilka'
    UNION ALL SELECT 'Čierny čaj so škoricou', 'Škorica'
    UNION ALL SELECT 'Čierny čaj so škoricou', 'Zázvor'
    UNION ALL SELECT 'Čierny čaj so škoricou', 'Vanilka'
    UNION ALL SELECT 'Jahodový jazmín', 'Jahoda'
    UNION ALL SELECT 'Jahodový jazmín', 'Jazmín'
    UNION ALL SELECT 'Malinový ibištek', 'Malina'
    UNION ALL SELECT 'Malinový ibištek', 'Ibištek'
    UNION ALL SELECT 'Večerná medovka', 'Medovka'
    UNION ALL SELECT 'Večerná medovka', 'Mäta'
    UNION ALL SELECT 'Večerná medovka', 'Levanduľa'
    UNION ALL SELECT 'Levanduľová záhrada', 'Levanduľa'
    UNION ALL SELECT 'Levanduľová záhrada', 'Medovka'
    UNION ALL SELECT 'Citrusový Earl Grey', 'Bergamot'
    UNION ALL SELECT 'Citrusový Earl Grey', 'Citrón'
    UNION ALL SELECT 'Citrusový Earl Grey', 'Pomaranč'
    UNION ALL SELECT 'Jablko so zázvorom', 'Jablko'
    UNION ALL SELECT 'Jablko so zázvorom', 'Zázvor'
    UNION ALL SELECT 'Jablko so zázvorom', 'Škorica'
    UNION ALL SELECT 'Rooibos lesné ovocie', 'Jahoda'
    UNION ALL SELECT 'Rooibos lesné ovocie', 'Malina'
    UNION ALL SELECT 'Rooibos lesné ovocie', 'Vanilka'
) AS sample
JOIN teas t ON t.name = sample.tea_name
JOIN flavors f ON f.name = sample.flavor_name
ON DUPLICATE KEY UPDATE flavor_id = VALUES(flavor_id);
