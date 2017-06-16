<?php
$vendor_id=$_SESSION['seller_id'];
				$order_details=order_details($vendor_id);
				
				if(is_array($order_details))
				{
					
						if(count($order_details))
						{
						echo "<table class='table'>
							<tr>
								<td>Order Id</td>
								<td>Order Date</td>
								<td>Order Time</td>
								<td>Sub Order Id</td>
								<td>Book Name</td>
								<td>Quatity</td>
								<td>Price</td>
								<td>Address</td>
								<td>Mode of Payment</td>
								<td>Status</td>
								<td>Remarks</td>
								<td></td>
							</tr>";
						
							
							$total=count($order_details);
							$pre_id=0;
							for($i=0;$i<$total;$i++)
							{
								$order_id=$order_details[$i]['order_id'];
									$sub_order_id=$order_details[$i]['sub_order_id'];
									$order_time=$order_details[$i]['order_time'];
									$order_date=$order_details[$i]['order_of_date'];
									$bk_name=$order_details[$i]['bk_name'];
									$bk_id=$order_details[$i]['bk_id'];
									$qnty=$order_details[$i]['qnty'];
									$price=$order_details[$i]['price'];
									$address=$order_details[$i]['address'];
									$payment=$order_details[$i]['payment'];
									$status=$order_details[$i]['status'];
									$remarks=$order_details[$i]['remarks'];
									
									if(strcasecmp($status,"Processing")==0)
											$cancel="<button class='btn btn-danger modificaiton' value='$order_id'>Cancel</button>";
										else
											$cancel="";
										
									if(strcasecmp($status,"Despatched")==0)
											$despatch="";
										else
										{
											if(strcasecmp($status,"Cancelled")==0)
												$despatch="";
											else
											$despatch="<button class='btn btn-warning despatch' value='$order_id' style='margin-top:10px;'>Despatch</button>";
										}
									
								if($order_details[$i]['order_id']==$order_details[$pre_id]['order_id'])
								{
																			
									if($i==0)
									{
										
										
										echo "<tr>
												<td>$order_id</td>
												<td>$order_date</td>
												<td>$order_time</td>
												<td>$sub_order_id</td>
												<td>$bk_name</td>
												<td>$qnty</td>
												<td>$price</td>
												<td>$address</td>
												<td>$payment</td>
												<td>$status</td>
												<td>$remarks</td>
												<td>$cancel  &nbsp; $despatch</td>
											</tr>";
									}
									else
									{
											echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td>$sub_order_id</td>
												<td>$bk_name</td>
												<td>$qnty</td>
												<td>$price</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>";
									}
									
								}
								else
								{
									echo "<tr>
												<td>$order_id</td>
												<td>$order_date</td>
												<td>$order_time</td>
												<td>$sub_order_id</td>
												<td>$bk_name</td>
												<td>$qnty</td>
												<td>$price</td>
												<td>$address</td>
												<td>$payment</td>
												<td>$status</td>
												<td>$remarks</td>
												<td>$cancel  &nbsp; $despatch</td>
											</tr>";
								}
								$pre_id=$i;
							}
							echo "</table>";
						}
					
					
				}
				else
					echo $order_details;
				
			
				
				
				?>