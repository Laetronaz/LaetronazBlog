--
-- Clean up all tags which aren't in use.
--

DELETE FROM `tags`
WHERE `id` not in (
  SELECT `tagpost`.`tag_id`
  FROM `tagpost`
);
COMMIT;
