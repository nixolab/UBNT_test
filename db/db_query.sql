# Seznam všech alb včetně interpreta, počtu skladeb na albu. Seřazeno dle názvu interpreta a názvu alba.
# ------------------------------------------------------------
SELECT `interpret`.`nazev` AS interpret_nazev, `album`.`nazev` AS album_nazev, COUNT(`album_skladba`.`id_album_skladba`) AS pocet_skladeb
FROM `album`
JOIN `album_interpret` ON `album`.`id_album` = `album_interpret`.`id_album`
JOIN `interpret` ON `album_interpret`.`id_interpret` = `interpret`.`id_interpret`
JOIN `album_skladba` ON `album`.`id_album` = `album_skladba`.`id_album`
GROUP BY `album_interpret`.`id_album_interpret`
ORDER BY interpret_nazev ASC, album_nazev ASC;


# Album včetně interpreta, které obsahuje nejdelší písničku.
# ------------------------------------------------------------
SELECT `interpret`.`nazev` AS interpret_nazev, `album`.`nazev` AS album_nazev
FROM `album`
JOIN `album_interpret` ON `album`.`id_album`  = `album_interpret`.`id_album`
JOIN `interpret` ON `album_interpret`.`id_interpret` = `interpret`.`id_interpret`
JOIN `album_skladba` ON `album`.`id_album` = `album_skladba`.`id_album`
WHERE `album_skladba`.`id_skladba` = (
	SELECT `skladba`.`id_skladba`
	FROM `skladba`
	ORDER BY `skladba`.`delka` DESC
	LIMIT 1
);