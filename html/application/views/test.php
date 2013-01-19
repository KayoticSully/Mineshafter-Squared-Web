<?php
// Edit this ->
define('MQ_SERVER_ADDR', 'server.mineshaftersquared.com');
define('MQ_SERVER_PORT', 25566);
define('MQ_TIMEOUT', 1);
// Edit this <-

// Display everything in browser, because some people can't look in logs for errors
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

require __DIR__ . '\..\libraries\Minecraftquery.php';

$timer = microtime(true);
$query = new minecraftQuery();

try {
    $query->connect(MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT);
}
catch (minecraftQueryException $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Minecraft Query PHP Class</title>
	
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
	<style type="text/css">
		footer {
			margin-top: 45px;
			padding: 35px 0 36px;
			border-top: 1px solid #e5e5e5;
		}
		footer p {
			margin-bottom: 0;
			color: #555;
		}
	</style>
</head>

<body>
    <div class="container">
    	<div class="page-header">
			<h1>Minecraft Query PHP Class</h1>
		</div>

<?php if( isset( $error ) ): ?>
		<div class="alert alert-info">
			<h4 class="alert-heading">Exception:</h4>
			<?php echo htmlspecialchars( $error ); ?>
		</div>
<?php else: ?>
		<div class="row">
			<div class="span6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2">Server info</th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $info = $query->getInfo( ) ) !== false ): ?>
<?php foreach( $info as $infoKey => $infoValue ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $infoKey ); ?></td>
							<td><?php
	if( is_array( $infoValue ) )
	{
		echo "<pre>";
		print_r( $infoValue );
		echo "</pre>";
	}
	else
	{
		echo htmlspecialchars( $infoValue );
	}
?></td>
						</tr>
<?php endforeach; ?>
<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="span6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Players</th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $players = $query->getPlayerList( ) ) !== false ): ?>
<?php foreach( $players as $player ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $player ); ?></td>
						</tr>
<?php endforeach; ?>
<?php else: ?>
						<tr>
							<td>No players in da house!</td>
						</tr>
<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
<?php endif; ?>
		<footer>
			<p class="pull-right">Generated in <span class="badge badge-success"><?php echo Number_Format( ( MicroTime( true ) - $timer ), 4, '.', '' ); ?>s</span></p>
			
			<p>Written by <a href="http://xpaw.ru" target="_blank">xPaw</a>. Modifications and additions by <a href="https://github.com/ivkos" target="_blank">ivkos</a>.</p>
			<p>Code licensed under the <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" target="_blank">CC BY-NC-SA 3.0</a></p>
			<p>Sourcecode available on <a href="https://github.com/ivkos/Minecraft-Query-for-PHP" target="_blank">GitHub</a></p>
		</footer>
	</div>
</body>
</html>