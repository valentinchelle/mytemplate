
 <div class="panel panel-default" style="border-radius : 0px;">
					<div class="panel-body">
						<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-success btn-filter" data-target="pagado">Non Lu</button>
								<button type="button" class="btn btn-warning btn-filter" data-target="pendiente">En attente</button>
								<button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Annulé</button>
								<button type="button" class="btn btn-default btn-filter" data-target="all">Tous</button>
							</div>
						</div>
						<div class="table-container">
							<table class="table table-filter">
							<tbody>
							<?php

							$sql = $bdd -> prepare("SELECT * FROM messages WHERE id_from = ? OR id_to = ?");
							$sql-> execute(array($_SESSION['id'], $_SESSION['id']));

							while($messages = $sql->fetch()){

							?>
							<tr data-status="pagado">
										<td onClick="location.href='index.php?p=discuss&discuss=<?php echo $messages['discuss']; ?>'">

											<a href="p=discuss&discuss_id=<?php echo $messages['discuss']; ?>">
												<div class="media">
													<a href="#" class="pull-left" style=" background : url(img/uploadsPP/pngweb.png) center no-repeat; border-radius : 50px;background-color:#fff;width : 50px; height : 50px; background-size: 50px 50px;">

													</a>

													<div class="media-body" style="padding-left:10px;">
														<span class="media-meta pull-right"><?php echo $messages['time']; ?></span>
														<h4 class="title">
															<?php echo htmlspecialchars($messages['title']); ?>
															<span class="pull-right pagado">Non Lu</span>
														</h4>
														<p class="summary"><?php echo htmlspecialchars($messages['content']); ?></p>
													</div>
												</div>

											</a>
										</td>

							</tr>





							<?php
							}
							$sql -> CloseCursor();
							?>


								</tbody>
							</table>
						</div>
					</div>
				</div>
