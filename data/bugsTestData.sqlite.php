<?php
$statements[] =<<<EOQ
INSERT INTO "user" ("username", "email", "fullname", "password", "role", "date_created") VALUES ('matthew', 'matthew@zend.com', "Matthew Weier O'Phinney", 'ae2b1fca515949e5d54fb22b8ed95575', 'developer', '2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "user" ("username", "email", "fullname", "password", "role", "date_created") VALUES ('ralph', 'ralph@zend.com', 'Ralph Schindler', 'ae2b1fca515949e5d54fb22b8ed95575', 'developer', '2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "user" ("username", "email", "fullname", "password", "role", "date_created") VALUES ('wils', 'wil@zend.com', 'Wil Sinclair', 'ae2b1fca515949e5d54fb22b8ed95575', 'user', '2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "user" ("username", "email", "fullname", "password", "role", "date_created") VALUES ('alex', 'alex@zend.com', 'Alex Veremyev', 'ae2b1fca515949e5d54fb22b8ed95575', 'user', '2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "user" ("username", "email", "fullname", "password", "role", "date_created") VALUES ('andi', 'andi@zend.com', 'Andi Gutmans', 'ae2b1fca515949e5d54fb22b8ed95575', 'user', '2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('1','1','1','3','3','1','a tortor. Nunc commodo auctor velit. Aliquam nisl.','arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque','2008-06-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('2','5','4','4','2','4','sed dictum eleifend, nunc','varius. Nam porttitor scelerisque neque. Nullam nisl. Maecenas malesuada fringilla est. Mauris eu turpis. Nulla aliquet. Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem','2008-02-12');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('3','3','2','4','2','3','egestas nunc sed libero.','metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat','2008-08-23', '2008-09-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('4','4','3','4','3','4','natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.','commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu','2008-09-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('5','1','1','1','3','1','augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna.','dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam porttitor scelerisque neque. Nullam nisl. Maecenas malesuada fringilla est. Mauris eu turpis. Nulla aliquet. Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum','2008-08-03');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('6','5','1','4','1','4','Pellentesque ut','lacinia orci, consectetuer euismod','2008-07-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('7','1','3','2','3','2','dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in','aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas','2008-02-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('8','1','4','4','3','5','leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce','Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui.','2008-06-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('9','4','1','4','1','1','egestas. Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit.','laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur','2008-08-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('10','5','1','3','3','1','imperdiet','nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam porttitor scelerisque neque. Nullam nisl. Maecenas malesuada fringilla est. Mauris eu turpis. Nulla aliquet. Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis','2008-01-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('11','4','2','4','1','3','mi tempor lorem, eget mollis lectus pede','massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean','2008-06-26');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('12','4','2','5','3','5','Vivamus euismod urna.','Donec est mauris, rhoncus id, mollis','2008-09-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved", "date_closed") VALUES ('13','1','5','2','2','5','sed tortor. Integer aliquam adipiscing lacus.','sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero.  Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut odio vel est tempor bibendum. Donec felis orci, adipiscing','2008-04-17', '2008-05-12', '2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('14','1','3','2','2','2','dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet','Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh.','2008-06-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('15','3','2','3','3','1','felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus','massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit','2008-04-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('16','5','1','4','1','2','luctus sit amet, faucibus ut, nulla. Cras eu tellus eu','semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend','2008-07-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('17','5','4','1','1','5','enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum,','posuere vulputate, lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu, euismod','2008-09-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('18','1','3','2','1','5','ac nulla. In tincidunt congue turpis. In condimentum. Donec at','blandit viverra. Donec tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla.','2008-07-04');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('19','3','4','3','1','4','Sed congue, elit sed consequat auctor, nunc nulla vulputate dui,','ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc','2008-04-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('20','2','2','4','3','1','Fusce feugiat. Lorem ipsum dolor sit amet,','id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque','2008-07-31');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('21','4','5','3','2','1','feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu, euismod ac, fermentum','diam nunc, ullamcorper eu, euismod ac, fermentum vel, mauris.  Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero.  Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor','2008-01-05', '2008-02-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('22','3','1','5','1','3','eget, venenatis a, magna. Lorem ipsum dolor sit amet,','placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie','2008-07-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('23','3','2','1','1','4','vulputate, nisi sem semper erat,','et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis','2008-04-12');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('24','2','3','4','2','1','rhoncus id, mollis nec, cursus a, enim. Suspendisse','mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida','2008-07-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('25','1','4','5','1','2','sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis','non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit. Pellentesque','2008-09-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('26','3','2','5','3','4','metus.','dis parturient montes, nascetur ridiculus','2008-09-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('27','1','5','1','2','2','orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet','a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum,','2008-04-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('28','3','1','3','1','1','nisi sem semper erat, in','magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus','2008-06-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('29','4','1','1','1','4','Quisque ornare tortor at risus. Nunc ac sem ut','facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at,','2008-05-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('30','5','2','2','2','3','netus et malesuada fames ac','tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel,','2008-09-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('31','3','5','3','2','3','ante dictum mi, ac mattis velit justo nec','Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus','2008-08-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('32','2','3','4','3','2','mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis,','Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris','2008-09-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_closed") VALUES ('33','3','2','1','3','2','id ante dictum cursus. Nunc mauris','nunc nulla vulputate dui, nec tempus mauris erat eget ipsum.  Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet.  Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus','2008-02-18', '2008-02-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('34','3','5','4','1','2','non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit','id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla','2008-08-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('35','1','4','4','2','5','quis massa. Mauris vestibulum,','arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros','2008-09-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('36','2','3','5','3','1','odio. Nam interdum enim','dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis','2008-05-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('37','3','5','3','1','3','velit justo nec ante.  Maecenas','diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna.  Suspendisse tristique neque venenatis lacus.','2008-09-03', '2008-09-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('38','3','1','2','3','2','amet, faucibus ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed auctor odio a','dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit','2008-07-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('39','4','2','3','1','4','pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi.','Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam','2008-09-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('40','3','4','4','3','2','Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus','nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus.','2008-07-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('41','4','3','5','2','5','tortor,','Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur','2008-04-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('42','4','1','1','2','5','Integer sem elit, pharetra ut, pharetra sed, hendrerit','aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus.','2008-09-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('43','5','2','5','3','4','ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis','lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et','2008-08-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('44','2','2','2','2','1','tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie','luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla','2008-06-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('45','3','2','3','3','1','lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada','Sed malesuada augue ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci,','2008-08-08');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('46','3','3','3','3','3','Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris','tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu','2008-02-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('47','1','5','2','3','2','Aenean gravida nunc sed pede. Cum sociis natoque penatibus et','nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices','2008-06-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('48','1','2','2','3','5','ac arcu. Nunc mauris. Morbi non sapien molestie','sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor.  Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes,','2008-09-09', '2008-09-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('49','5','4','1','1','2','placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet,','sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a,','2008-09-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('50','4','3','2','1','4','vel, faucibus id, libero.','nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna','2008-03-19');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('51','2','5','3','3','1','pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit.','est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec','2008-09-03');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('52','4','1','3','1','5','dictum placerat, augue. Sed','sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.','2008-02-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('53','5','1','3','3','4','diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos','fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus','2008-05-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_closed") VALUES ('54','3','3','1','1','5','et, rutrum','non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa.  Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim.  Suspendisse aliquet, sem ut','2008-02-13', '2008-02-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('55','2','1','5','1','4','sed turpis','sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis','2008-07-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('56','4','1','2','1','5','aliquet odio. Etiam ligula tortor, dictum','Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut','2008-07-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('57','4','1','5','1','4','dictum eleifend, nunc risus varius orci, in consequat','faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula.','2008-04-13');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('58','3','2','1','2','3','rutrum non,','sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis','2008-06-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('59','4','1','4','3','5','cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem,','a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem','2008-09-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('60','3','1','4','2','5','dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam','interdum ligula eu enim. Etiam imperdiet dictum magna.','2008-09-29');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('61','5','3','2','1','1','ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius.','purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu,','2008-07-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('62','3','2','5','1','5','at','sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam.','2008-08-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('63','5','5','2','3','2','sem eget massa. Suspendisse eleifend. Cras sed','turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti','2008-06-29');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('64','2','3','2','3','3','posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat,','eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris','2008-05-10');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('65','5','1','3','1','4','eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus','ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est','2008-02-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('66','5','5','2','3','5','adipiscing lobortis','Duis elementum, dui quis accumsan convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis.','2008-09-04', '2008-09-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('67','4','5','3','3','2','odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec','viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac,','2008-09-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('68','5','2','1','3','2','eu, eleifend nec, malesuada','vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et,','2008-02-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('69','5','1','5','2','5','Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu','et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia','2008-09-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('70','4','5','1','1','4','et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo','In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere','2008-04-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('71','3','3','2','3','3','Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et','enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at,','2008-09-16');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_deleted") VALUES ('72','2','2','1','1','2','lobortis augue scelerisque','arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi.  Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu.  Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum.  Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec','2008-09-20', '2008-09-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('73','5','2','5','2','1','non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris','ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque.','2008-02-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('74','3','1','5','3','4','dictum. Proin eget odio. Aliquam vulputate ullamcorper','facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque','2008-09-13');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('75','5','4','1','3','5','nonummy ultricies ornare, elit elit fermentum risus,','quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec','2008-09-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('76','5','2','2','1','1','Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus.','nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing','2008-09-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('77','5','1','1','1','4','eu, eleifend nec, malesuada','fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget','2008-09-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('78','4','4','3','2','3','dolor, tempus','odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices','2008-09-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('79','1','5','2','3','5','egestas. Aliquam nec enim. Nunc ut erat.','sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et','2008-09-20');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('80','4','5','1','2','4','massa lobortis ultrices. Vivamus','purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc','2008-07-12');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('81','5','1','3','3','4','ac','Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a,','2008-06-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('82','2','5','3','2','1','quis urna. Nunc quis arcu vel quam','nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit','2008-05-04');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('83','1','5','2','3','4','elit. Etiam laoreet,','ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In','2008-01-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('84','5','5','5','3','5','lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat','ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat','2008-09-16');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('85','2','5','1','3','2','cubilia','non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae','2008-08-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('86','4','3','5','3','4','nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla','nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis','2008-09-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('87','2','1','4','1','1','risus odio, auctor vitae, aliquet nec, imperdiet nec, leo. Morbi neque','Etiam gravida molestie arcu. Sed eu nibh vulputate','2008-07-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('88','5','2','1','3','4','Donec tincidunt.','eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut odio vel est tempor bibendum. Donec felis orci, adipiscing non, luctus sit amet, faucibus ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed auctor odio a purus. Duis elementum,','2008-09-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('89','4','4','2','3','2','tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit','varius orci, in consequat enim diam vel arcu. Curabitur ut odio vel est tempor bibendum. Donec felis orci, adipiscing non, luctus sit amet, faucibus ut, nulla.','2008-05-26');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('90','4','3','5','1','5','vitae,','a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis.','2008-09-10');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('91','4','5','2','1','5','urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim.','rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam','2008-09-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('92','3','2','4','3','1','augue id ante dictum cursus. Nunc mauris','Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris','2008-01-31');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('93','5','4','5','2','2','lobortis risus. In mi pede, nonummy ut,','per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit','2008-03-05');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('94','2','3','2','2','1','fermentum metus. Aenean sed','tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis','2008-08-12');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('95','2','4','4','2','2','vel','fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis.','2008-04-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('96','5','2','5','2','2','justo sit amet nulla. Donec non justo. Proin non massa non','tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam','2008-02-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('97','1','5','3','2','1','ullamcorper. Duis','ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet','2008-09-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('98','5','1','4','3','3','Nunc commodo auctor velit. Aliquam nisl. Nulla','pede. Praesent eu dui. Cum sociis natoque penatibus et magnis','2008-07-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('99','4','3','5','3','3','elit sed consequat','a purus. Duis','2008-09-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('100','3','4','1','2','4','et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan','Nunc pulvinar arcu et pede. Nunc','2008-03-31');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('101','1','4','3','2','3','Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio.','Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut','2008-06-14');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('102','3','1','1','1','5','lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus','Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis','2008-07-13');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('103','1','2','1','2','5','mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl.','lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est','2008-06-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_deleted") VALUES ('104','4','2','3','3','3','Sed eget lacus.','Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices.  Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;','2008-02-17', '2008-02-19');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('105','5','5','2','3','3','arcu. Vivamus sit amet risus. Donec egestas.','molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida','2008-08-19');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('106','5','3','5','3','4','netus et malesuada fames ac turpis','at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante','2008-08-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('107','5','5','3','1','3','netus et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque','molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus.','2008-09-15', '2008-09-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('108','1','3','2','3','2','amet, consectetuer adipiscing','venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit viverra. Donec tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna','2008-09-08');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('109','2','2','2','3','1','mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis,','interdum. Sed auctor odio a purus. Duis elementum, dui quis','2008-09-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('110','5','1','4','1','1','orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna','elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing','2008-09-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('111','3','1','3','3','2','varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit','sollicitudin','2008-02-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('112','1','5','3','3','2','erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac urna.','sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam','2008-09-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('113','5','4','2','1','4','pharetra ut, pharetra sed, hendrerit a, arcu.','eu turpis. Nulla aliquet. Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut odio vel est tempor bibendum. Donec felis orci, adipiscing non, luctus sit','2008-06-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('114','3','3','4','3','5','nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et','Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris','2008-06-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('115','1','3','1','2','3','cursus non, egestas','magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum','2008-04-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('116','1','2','4','1','1','sed dui. Fusce aliquam, enim nec','nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu','2008-09-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('117','5','2','5','1','5','dolor quam, elementum at, egestas a,','lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit.','2008-08-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('118','5','5','4','1','1','a, auctor non,','dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu.','2008-09-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('119','3','4','1','1','5','vel quam dignissim pharetra. Nam','orci, adipiscing non,','2008-03-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('120','1','3','5','1','2','Aenean massa. Integer vitae','sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut,','2008-09-10');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('121','3','4','5','3','4','lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim','neque sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim.','2008-04-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_deleted") VALUES ('122','4','1','3','2','3','aliquet diam. Sed diam','vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis.  Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas.','2008-06-22', '2008-06-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('123','4','2','1','1','3','mauris ut mi. Duis risus odio, auctor vitae, aliquet','ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu, euismod ac, fermentum vel, mauris. Integer sem elit, pharetra ut, pharetra sed,','2008-08-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('124','2','5','4','2','2','rhoncus. Proin nisl sem, consequat nec,','lacus. Quisque purus sapien,','2008-09-06', '2008-09-11');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('125','1','3','5','3','1','purus. Duis elementum, dui quis accumsan convallis, ante lectus convallis est, vitae sodales nisi magna','nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras','2008-07-25');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('126','4','5','1','3','3','sem egestas blandit. Nam nulla magna, malesuada vel, convallis','vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a','2008-09-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('127','3','4','4','2','5','elementum at, egestas a, scelerisque sed, sapien. Nunc','metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi','2008-09-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('128','2','3','5','2','3','eget lacus. Mauris non dui nec','parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas','2008-08-26');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('129','1','5','1','3','4','vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et','convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit','2008-06-19');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('130','3','2','1','2','4','in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet','dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu','2008-01-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('131','4','1','5','2','3','ut odio vel est tempor','Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra,','2008-01-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('132','5','1','2','2','2','faucibus lectus,','pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum.','2008-05-17');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('133','2','5','1','3','2','commodo ipsum. Suspendisse non leo. Vivamus','mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc','2008-05-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('134','4','5','1','2','4','cubilia Curae; Phasellus ornare. Fusce','erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac','2008-07-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('135','3','4','4','2','3','tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo.','id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper','2008-09-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('136','4','2','1','2','4','suscipit,','Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec','2008-09-19');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('137','5','2','1','1','1','at augue','eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit','2008-09-10');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('138','3','4','1','1','2','Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede','ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec,','2008-09-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('139','5','2','1','1','5','sodales. Mauris blandit enim consequat purus. Maecenas','netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy','2008-03-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('140','1','1','3','2','5','faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin','Maecenas mi','2008-02-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('141','4','1','2','2','4','eros non','et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam porttitor scelerisque neque.','2008-09-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('142','2','5','5','2','5','Etiam ligula tortor,','Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac','2008-03-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('143','2','1','3','1','2','luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget,','in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id,','2008-05-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('144','4','2','4','2','1','commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis','magna sed dui.  Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor.','2008-07-02', "2008-07-09");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('145','1','1','3','2','3','euismod urna. Nullam lobortis quam a felis','Pellentesque tincidunt tempus risus. Donec','2008-07-24');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('146','3','5','1','3','1','torquent per conubia nostra,','tempor bibendum. Donec felis orci, adipiscing non, luctus sit amet, faucibus ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed auctor odio a purus. Duis elementum, dui quis accumsan convallis, ante lectus convallis est,','2008-05-26');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('147','5','1','1','2','4','eu eros. Nam consequat dolor vitae dolor. Donec','nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis','2008-05-04');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('148','5','2','1','2','2','neque sed sem','et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero.','2008-09-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('149','2','1','4','2','3','vel quam dignissim pharetra. Nam ac nulla. In','Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas','2008-08-10');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('150','5','3','5','2','3','vestibulum.','quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum','2008-02-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('151','1','1','1','2','5','penatibus et magnis dis parturient','et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit','2008-04-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('152','5','2','2','2','3','sit amet risus. Donec egestas.','Duis volutpat nunc sit amet metus.','2008-09-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('153','3','4','1','1','4','et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien,','habitant morbi tristique senectus et netus et malesuada fames ac turpis','2008-01-15');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('154','1','4','5','3','4','ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a','semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac','2008-06-26');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('155','1','5','2','3','4','ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy','Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus','2008-09-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('156','2','2','1','1','5','Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem,','blandit','2008-09-10');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('157','5','1','4','3','1','ut dolor dapibus gravida. Aliquam','pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus.','2008-09-08');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('158','5','4','2','3','4','cursus non, egestas a, dui.','Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas.','2008-09-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('159','4','3','2','2','4','tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum','felis orci, adipiscing non, luctus sit amet, faucibus ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed auctor odio a purus. Duis elementum, dui quis accumsan convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis','2008-08-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('160','3','5','3','1','5','ligula. Donec luctus aliquet odio. Etiam ligula tortor,','Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris','2008-06-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('161','1','4','2','1','4','ac','vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique','2008-07-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('162','4','3','2','3','2','leo elementum sem, vitae aliquam eros turpis non enim. Mauris','faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient','2008-06-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('163','4','3','1','1','1','magna','ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor','2008-02-14');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('164','1','1','4','3','1','malesuada fames ac turpis egestas. Fusce aliquet magna a','vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per','2008-09-31');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('165','1','4','4','3','3','nunc est, mollis non, cursus non,','nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec','2008-09-08');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('166','4','4','3','1','2','ultrices','eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus.','2008-05-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('167','1','2','3','1','2','quam. Pellentesque habitant morbi tristique senectus et netus','magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus','2008-07-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('168','3','1','5','3','2','orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet','urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas','2008-03-13');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('169','4','2','5','1','5','Donec tincidunt. Donec vitae erat vel pede blandit','facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus','2008-06-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('170','4','1','2','3','2','in magna. Phasellus dolor elit, pellentesque a, facilisis non,','Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero. Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor vitae, aliquet','2008-02-03');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('171','5','1','1','2','3','dictum magna. Ut tincidunt','accumsan convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum','2008-09-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('172','2','4','3','3','2','interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis','orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc','2008-06-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('173','1','2','4','3','1','at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed','id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor.  Quisque','2008-07-16', '2008-07-29');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('174','5','3','2','3','3','Aliquam erat volutpat. Nulla facilisis. Suspendisse','nisi sem semper erat, in consectetuer ipsum nunc id','2008-09-12');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('175','1','4','1','2','1','Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus','neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec','2008-09-01');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('176','5','2','4','2','3','est. Mauris eu','auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi','2008-03-31');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('177','2','3','3','1','3','rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit','Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc','2008-09-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('178','5','1','3','3','1','semper erat, in','et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis','2008-04-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('179','4','5','1','3','5','Curabitur ut odio vel est tempor bibendum.','egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque','2008-09-23');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('180','3','5','2','3','1','molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor','mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere','2008-09-28');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('181','2','5','3','2','4','sem, vitae aliquam eros turpis non enim. Mauris quis','dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed','2008-08-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('182','2','3','3','2','1','eget tincidunt dui augue eu tellus. Phasellus','non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per','2008-06-07');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('183','1','1','4','3','4','Praesent eu nulla at sem molestie sodales. Mauris blandit','augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit viverra. Donec tempus,','2008-05-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('184','5','5','5','1','1','bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat,','magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque','2008-02-21');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('185','1','5','5','3','2','Nulla tincidunt, neque vitae semper egestas, urna','lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut odio vel est tempor bibendum. Donec felis orci, adipiscing non, luctus sit amet, faucibus ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed auctor odio a purus. Duis elementum, dui quis accumsan convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse','2008-09-29');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('186','5','3','1','1','3','Suspendisse ac metus vitae velit egestas','feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris','2008-03-11');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('187','2','4','4','3','4','risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc','magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus','2008-09-22');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('188','4','3','4','1','3','ac ipsum. Phasellus vitae mauris sit amet lorem semper','vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque','2008-06-11');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('189','4','5','4','1','4','lorem, luctus ut,','est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate','2008-08-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('190','4','3','2','3','4','vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet,','convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim,','2008-01-29');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('191','1','4','2','1','2','cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt','ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam','2008-09-02');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('192','1','4','4','1','2','In tincidunt congue turpis. In condimentum. Donec at arcu.','orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie.','2008-06-30');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('193','5','4','5','2','2','nulla. Integer vulputate, risus a ultricies adipiscing,','odio. Phasellus at','2008-06-08');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('194','4','3','5','1','4','at, nisi. Cum sociis natoque penatibus et magnis dis','Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis','2008-09-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('195','1','2','3','2','3','est mauris, rhoncus id,','sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit','2008-09-06');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('196','4','2','5','3','1','nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim','eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut','2008-09-18');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created", "date_resolved") VALUES ('197','2','4','5','2','3','quis, tristique ac, eleifend vitae, erat. Vivamus nisi.','nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus','2008-09-22', '2008-09-27');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('198','5','2','5','3','3','Cum sociis natoque penatibus','Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero','2008-07-09');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('199','3','1','2','1','4','Quisque nonummy ipsum non arcu. Vivamus sit amet risus.','Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate','2008-02-04');
EOQ;

$statements[] =<<<EOQ
INSERT INTO "bug" ("id","reporter_id","developer_id","priority_id","type_id","resolution_id","summary","description","date_created") VALUES ('200','4','3','3','2','5','cursus in, hendrerit consectetuer, cursus','pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat','2008-08-29');
EOQ;

return $statements;
