<?php include 'base.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>卓越科技大學校園資訊系統</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-1.9.1.min.js"></script>
	<script src="./js/js.js"></script>
</head>

<body>
	<div id="cover" style="display:none; ">
		<div id="coverr">
			<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl('#cover')">X</a>
			<div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
		</div>
	</div>
	<div id="main">
		<a title="<?= $title['text']; ?>" href="index.php">
			<div class="ti" style="background:url('img/<?= $title['img']; ?>'); background-size:cover;"></div><!--標題-->
		</a>
		<div id="ms">
			<div id="lf" style="float:left;">
				<div id="menuput" class="dbor">
					<!--主選單放此-->
					<span class="t botli">主選單區</span>
					<?php
					//先載入主選單，並加上相應的html內容
					$menu = new DB("menu");
					$mains = $menu->all(['parent' => 0, 'sh' => 1]);
					foreach ($mains as $main) {
						echo "<div class='mainmu'>";
						echo "<a href='" . $main['href'] . "'>";
						echo $main['name'];
						echo "</a>";

						//檢查是否有次選單，有的話則撈出次選單並加上相應的html內容
						$chksub = $menu->count(['parent' => $main['id']]);
						if ($chksub > 0) {
							$subs = $menu->all(['parent' => $main['id']]);
							echo "<div class='mw'>";
							foreach ($subs as $sub) {
								echo "<div class='mainmu2'><a href='" . $sub['href'] . "'>" . $sub['name'] . "</a></div>";
							}
							echo "</div>";
						}
						echo "</div>";
					}
					?>
				</div>
				<div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
					<span class="t">進站總人數 : <?php echo $total['total']; ?></span>
				</div>
			</div>
			<!--include-->
			<?
			if (!empty($_GET['do'])) {
				$do = $_GET['do'];
			} else {
				$do = 'main';
			}

			$file = 'front/' . $do . '.php';

			if (file_exists($file)) {
				include $file;
			} else {
				include 'front/main.php';
			}
			?>
			<!--include-->
			<div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
				<!--右邊-->
				<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo('?do=login')">管理登入</button>
				<div style="width:89%; height:480px;" class="dbor">
					<span class="t botli">校園映象區</span>
					<div class='cent' onclick='pp(1)'><img src='icon/up.jpg'></div>
					<?php
					$img = $Image->all(['sh' => 1]);
					foreach ($img as $key => $im) {
					?>
						<div class='cent im' id='ssaa<?= $key; ?>'><img src='img/<?= $im['img']; ?>' style='width:150px;height:103px;border:3px solid orange;margin:3px'></div>
					<?php
					}
					?>
					<div class='cent' onclick='pp(2)'><img src='icon/dn.jpg'></div>
					<script>
						var nowpage = 0,
							num = <?= count($img); ?>;

						function pp(x) {
							var s, t;
							if (x == 1 && nowpage - 1 >= 0) {
								nowpage--;
							}
							if (x == 2 && (nowpage + 1) * 3 <= num - 3) {
								nowpage++;
							}
							$(".im").hide()
							for (s = 0; s <= 2; s++) {
								t = s * 1 + nowpage * 1;
								$("#ssaa" + t).show()
							}
						}
						pp(1)
					</script>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
			<span class="t" style="line-height:123px;"><?php echo $bottom['bottom']; ?></span>
		</div>
	</div>

</body>

</html>