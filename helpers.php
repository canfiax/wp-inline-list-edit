<?php
 	function wpille_pluginUrl($path = '') {
		return plugin_dir_url(__FILE__) . $path;
	}

	function get_post_table_columns() {
		global $wpdb;

		$query = "
			DESCRIBE " . $wpdb->prefix . "posts
		";

		$column = array();


		foreach($wpdb->get_results($query) as $row)
			$columns[] = $row->Field;

		return $columns;
	}

	function get_post_meta_keys() {
		global $wpdb;

		$query = "
			SELECT
				meta_key as `key`,
				p.post_type
			FROM
				" . $wpdb->prefix . "postmeta meta
			INNER JOIN
				" . $wpdb->prefix . "posts p ON p.ID = meta.post_id
			GROUP BY
				meta.meta_key
		";
		$meta_keys = array();

		foreach($wpdb->get_results($query) as $meta)
			$meta_keys[] = $meta->key;

		return $meta_keys;
	}


	function wpille_keyToReadable($string) {
		return ucfirst(str_replace(['-', '_'], ' ', $string));
	}