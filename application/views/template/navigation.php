<ul class="nav navbar-nav">
   <li><a href="<?php echo base_url();?>user/dashboard">Dashboard</a></li>
   <li class="menu-dropdown classic-menu-dropdown ">
      <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;"> 
         My Sites <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu pull-left">
         <li>
         	<a href="<?php echo base_url();?>MySite/list_sites"> List Site </a>
         </li>
         <li>
         	<a href="<?php echo base_url();?>MySite"> Add New Site</a>
         </li>
		 <li>
            <a href="<?php echo base_url();?>MySite/addMysiteKey"> Add Site Field keyword</a>
         </li>
      </ul>
   </li>
   <li class="menu-dropdown classic-menu-dropdown ">
      <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;"> 
         Offers <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu pull-left">
         <li>
         	<a href="<?php echo base_url();?>offer/list_offers"> List Offers </a>
         </li>
         <li>
         	<a href="<?php echo base_url();?>offer/add_offer"> Add New Offer </a>
         </li>
      </ul>
   </li>
   <li class="menu-dropdown classic-menu-dropdown">
      <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;"> 
      	Clients <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu pull-left">
         <li>
         	<a href="<?php echo base_url();?>client/list_clients"> List Clients </a>
         </li>
         <li>
         	<a href="<?php echo base_url();?>client/index"> Add New client </a>
         </li>
      </ul>
   </li>
   <li class="menu-dropdown classic-menu-dropdown ">
      <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;"> 
      	Reports <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu pull-left">
         <li>
         	<a href="<?php echo base_url();?>reports/list_client_trans"> Client Transactions</a>
         </li>
         <li>
         	<a href="<?php echo base_url();?>reports/list_offer_data"> Offer Data</a>
         </li>
         <li>
         	<a href="<?php echo base_url();?>reports/affiliate_report"> Affiliate Report</a>
         </li>
		 <li>
         	<a href="<?php echo base_url();?>reports/offer_report"> Offer Report</a>
         </li>
      </ul>
   </li>
   <li>
      <a href="<?php echo base_url();?>user/instructions"> 
      	Instructions 
      </a>     
   </li>
</ul>