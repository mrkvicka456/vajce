SET NAMES utf8mb4;

-- Doplnia sa iba chybajuce nazvy; existujuce ceny a popisy sa nemenia.
INSERT INTO teas (name, category, origin, weight, price, description)
SELECT sample.name, sample.category, sample.origin, sample.weight, sample.price, sample.description
FROM (
    SELECT 'Sencha' AS name, 'zelene' AS category, 'Japonsko' AS origin, 100 AS weight, 5.90 AS price, 'Jemná, svieža chuť' AS description
    UNION ALL SELECT 'Earl Grey', 'cierne', 'Srí Lanka', 100, 4.80, 'Čierny čaj s citrusovou arómou.'
    UNION ALL SELECT 'Rooibos vanilka', 'rooibos', 'Južná Afrika', 100, 5.20, 'Jemná zmes s prirodzene sladkastou chuťou.'
    UNION ALL SELECT 'Mätový čaj', 'bylinne', 'Slovensko', 50, 3.50, 'Svieži bylinný čaj vhodný aj na studenú prípravu.'
    UNION ALL SELECT 'Jazmínový čaj', 'zelene', 'Čína', 100, 6.50, 'Ľahký zelený čaj s kvetinovou arómou.'
    UNION ALL SELECT 'Lesné ovocie', 'ovocne', 'Slovensko', 100, 4.90, 'Ovocná zmes s plnou chuťou a sýtym nálevom.'
    UNION ALL SELECT 'Zelený čaj s mätou a citrónom', 'zelene', 'Čína', 100, 6.20, 'Zelený čaj so sviežou bylinnou a citrusovou chuťou.'
    UNION ALL SELECT 'Zázvorový citrón', 'bylinne', 'Slovensko', 100, 4.60, 'Výrazná bylinná zmes s pikantným záverom.'
    UNION ALL SELECT 'Zimné jablko', 'ovocne', 'Slovensko', 100, 5.40, 'Ovocná zmes so sladkými a korenistými tónmi.'
    UNION ALL SELECT 'Rooibos pomaranč a vanilka', 'rooibos', 'Južná Afrika', 100, 6.10, 'Sladkastý rooibos s jemným citrusovým záverom.'
    UNION ALL SELECT 'Čierny čaj so škoricou', 'cierne', 'India', 100, 5.90, 'Plný čierny čaj doplnený koreninami.'
    UNION ALL SELECT 'Jahodový jazmín', 'zelene', 'Čína', 100, 6.70, 'Zelený čaj spájajúci ovocné a kvetinové tóny.'
    UNION ALL SELECT 'Malinový ibištek', 'ovocne', 'Slovensko', 100, 5.20, 'Svieža ovocná zmes s príjemne kyslastou chuťou.'
    UNION ALL SELECT 'Večerná medovka', 'bylinne', 'Slovensko', 50, 4.10, 'Jemná bylinná zmes s kvetinovým tónom.'
    UNION ALL SELECT 'Levanduľová záhrada', 'bylinne', 'Slovensko', 50, 4.50, 'Voňavá zmes bylín a kvetov.'
    UNION ALL SELECT 'Citrusový Earl Grey', 'cierne', 'Srí Lanka', 100, 5.80, 'Čierny čaj s výraznou citrusovou arómou.'
    UNION ALL SELECT 'Jablko so zázvorom', 'ovocne', 'Slovensko', 100, 5.10, 'Ovocný čaj s korenistým záverom.'
    UNION ALL SELECT 'Rooibos lesné ovocie', 'rooibos', 'Južná Afrika', 100, 6.30, 'Rooibos s ovocnou chuťou a jemne sladkou vôňou.'
) AS sample
LEFT JOIN teas existing ON existing.name = sample.name
WHERE existing.id IS NULL;
