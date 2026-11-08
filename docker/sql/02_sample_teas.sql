SET NAMES utf8mb4;

INSERT INTO teas (id, name, category, origin, weight, price, description) VALUES
    (1, 'Sencha', 'zelene', 'Japonsko', 100, 5.90, 'Jemná, svieža chuť'),
    (2, 'Earl Grey', 'cierne', 'Srí Lanka', 100, 4.80, 'Príchuť: bergamot'),
    (3, 'Rooibos vanilka', 'rooibos', 'Južná Afrika', 100, 5.20, 'Príchuť: vanilka'),
    (4, 'Mätový čaj', 'bylinne', 'Slovensko', 50, 3.50, 'Príchuť: mäta'),
    (5, 'Jazmínový čaj', 'zelene', 'Čína', 100, 6.50, 'Príchuť: jazmín'),
    (6, 'Lesné ovocie', 'ovocne', 'Slovensko', 100, 4.90, 'Príchute: malina, jahoda')
ON DUPLICATE KEY UPDATE id = VALUES(id);
