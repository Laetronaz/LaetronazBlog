--
-- Clean up all tags which aren't in use.
--

DELETE FROM `tags`
WHERE `id` not in (
  SELECT `tag_post`.`tag_id`
  FROM `tag_post`
);
COMMIT;
