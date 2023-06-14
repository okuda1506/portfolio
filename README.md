# portfolio
ポートフォリオを新しく作り直しました。

SNSアプリとデータ登録アプリのテーブル作成クエリは下記の通り。
```sql
========================== bulletinBoard ==========================
テーブルの構造 `members`

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

テーブルのデータをダンプしています `members`
`posts`
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `reply_post_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


========================== registerapp ==========================

CREATE TABLE `people` (
`id` INT NOT NULL AUTO_INCREMENT , 
`lastName` TEXT NOT NULL , 
`middleName` TEXT NOT NULL , 
`firstName` TEXT NOT NULL , 
`email` TEXT NOT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB ;
```

古いポートフォリオのソースは[こちら](https://github.com/okuda1506/old_portfolio)から
