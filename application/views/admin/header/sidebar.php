            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                     <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="menu" id="dashboardMenu">
                                    <a href="<?php echo site_url();?>admin/dashboard">
                                        <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                                  <li class="menu" id="bannerMenu">
                                    <a href="<?php echo site_url();?>admin/banner">
                                        <span class="pcoded-micon"><i class="fa fa-columns"></i></span>
                                        <span class="pcoded-mtext">Banners</span>
                                    </a>
                                </li>
                                 <li class="menu" id="categoryMenu">
                                      <a href="<?php echo site_url();?>admin/subcategory">
                                         <span class="pcoded-micon"><i class="fa fa-th-large"></i></span>
                                            <span class="pcoded-mtext" >Category</span>
                                      </a>
                                 </li>
                                
                                <!-- <li class="menu" id="customerMenu">
                                   <a href="<?php echo site_url();?>admin/usersList">
                                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                     <span class="pcoded-mtext" >Users</span>
                                   </a>
                                </li> -->

                                <li class="menu" id="buyerMenu">
                                   <a href="<?php echo site_url();?>admin/buyerlist">
                                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                     <span class="pcoded-mtext" >Buyer List</span>
                                   </a>
                                </li>
                                 <li class="menu" id="sellerMenu">
                                   <a href="<?php echo site_url();?>admin/sellerlist">
                                    <span class="pcoded-micon"><i class="fa fa-user-plus"></i></span>
                                     <span class="pcoded-mtext" >Seller List</span>
                                   </a>
                                </li>

                                 <li class="menu" id="gigMenu">
                                     <a href="<?php echo site_url();?>admin/giglist">
                                        <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                                        <span class="pcoded-mtext">Gigs</span>
                                         <span class="pcoded-badge label label-danger"><?php echo $gig_count?></span>
                                     </a>
                                 </li>
                          
                                 <li class="menu" id="requestMenu">
                                     <a href="<?php echo site_url();?>admin/requestlist">
                                        <span class="pcoded-micon"><i class="fa fa-send"></i></span>
                                        <span class="pcoded-mtext">Request List</span>
                                     </a>
                                 </li>
                                 <li class="menu" id="myOrderMenu">
                                     <a href="<?php echo site_url();?>admin/myorder">
                                        <span class="pcoded-micon"><i class="fa fa-table"></i></span>
                                        <span class="pcoded-mtext">Orders</span>
                                     </a>
                                 </li>
                                 <li class="menu" id="reportMenu">
                                     <a href="<?php echo site_url();?>admin/report">
                                        <span class="pcoded-micon"><i class="feather icon-alert-circle"></i></span>
                                        <span class="pcoded-mtext">Report</span>
                                     </a>
                                 </li>
                                 <li class="menu" id="disputeMenu">
                                     <a href="<?php echo site_url();?>admin/dispute">
                                        <span class="pcoded-micon"><i class="feather icon-alert-triangle"></i></span>
                                        <span class="pcoded-mtext">Dispute</span>
                                     </a>
                                 </li>
                                 <li class="menu" id="statisticsMenu">
                                     <a href="<?php echo site_url();?>admin/statistics">
                                        <span class="pcoded-micon"><i class="fa fa-bookmark-o"></i></span>
                                        <span class="pcoded-mtext">Statistics</span>
                                     </a>
                                 </li>
                                  <li class="menu" id="withdrawMenu">
                                     <a href="<?php echo site_url();?>admin/walletWithDraw">
                                        <span class="pcoded-micon"><i class="fa fa-money"></i></span>
                                        <span class="pcoded-mtext">Wallet Withdraw</span>
                                     </a>
                                 </li>
                                  <li class="pcoded-hasmenu" id="cmsMenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="fa fa-list-alt"></i></span>
                                            <span class="pcoded-mtext" >CMS</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="menu" id="termsMenu">
                                                <a href="<?php echo site_url();?>admin/termsAndCondition">
                                                    <span class="pcoded-mtext" >Terms & Conditions</span>
                                                </a>
                                            </li>
                                            <li class="menu" id="privacyMenu">
                                                <a href="<?php echo site_url();?>admin/privacyPolicy">
                                                    <span class="pcoded-mtext" >Privacy Policy</span>
                                                </a>
                                            </li>
                                             <li class="menu" id="helpMenu">
                                                <a href="<?php echo site_url();?>admin/help">
                                                    <span class="pcoded-mtext" >Help & Support</span>
                                                </a>
                                            </li>
                                             <li class="menu" id="contactMenu">
                                                <a href="<?php echo site_url();?>admin/contact">
                                                    <span class="pcoded-mtext" >Contact Us</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                      
                                    <li class="menu" id="settingMenu">
                                        <a href="<?php echo site_url();?>admin/settings" >
                                            <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                                            <span class="pcoded-mtext">Settings</span>
                                        </a>
                                    </li>
                                     <li class="menu" id="passwordMenu">
                                        <a href="<?php echo site_url();?>admin/changepassword" >
                                            <span class="pcoded-micon"><i class="feather icon-lock"></i></span>
                                            <span class="pcoded-mtext">Change Password</span>
                                        </a>
                                    </li>
                                    <li class="menu">
                                        <a href="<?php echo site_url();?>admin/logout">
                                            <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                                            <span class="pcoded-mtext">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>