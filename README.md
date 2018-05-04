![project tools logo](https://project-tools.co.uk/project-tools.png)

Project Tools
----
Project Tools is a web based work (change or project) request system that provides a form with a set of simple and straight forward questions to allow business directors to assess if the work is initially worth doing and if so to then manage the ongoing process of working out how that request will be carried out, how much it will cost and when it can be delivered.

The idea is that the right resources are used at the right time, by only getting specific stakeholders involved when they need to be involved.

Once a request is assessed, analysed, costed and scheduled it is then ready for managerial approval. Once approved, the work is then implemented according to the agreed schedule and then upon successful testing, signed off as completed.

Project Tools was created to ensure work is delivered when it is scheduled to be delivered. This may sound overly simplistic, but experience has shown that 'too many cooks' jump in and divert resources from agreed scheduled work to do 'something else'. This causes frustration upon both those doing the work and those trying to manage it.

By adhering to this simple process, businesses can align work requests with roadmaps and strategies to set realistic targets based on available resources.

The process has been refined over many years, from a paper based system to a procedural PHP based proof-of-concept and more recently converted to utilise the Laravel framework.


Pre-requisites:
---
* LAMP stack
 * Initial system developed upon Ubuntu 16.04 LTS
 * Successfully tested upon Ubunto 18.04 LTS
* Apache server, configured to provide a target web site
* MySQL database & associated user account
* At least 2GB RAM, for install
* Composer

* Nodejs

* Understanding of Laravel command line
 * Full deployment instructions provided

* SMTP Mail service

Installation Overview
---

* Clone the git repo to the target Apache web folder.

* Edit <targetSite>.conf Apache config file to point to Laravel installation /public/ folder

* Edit Laravel **.env** with your system variables

* Composer update

* Run the Laravel database migrations & seeder.

* Test ability to see the site, login and confirm initial dummy/test record.

Please refer to the **INSTALLATION.md** for full installation instructions.