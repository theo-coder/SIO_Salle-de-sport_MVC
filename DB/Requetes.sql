-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 10.0.3              
-- * Generator date: Aug 17 2017              
-- * Generation date: Thu Apr 23 14:14:22 2020 
-- * LUN file: C:\WSL\www\PHP\Projet\DB\MCD.lun 
-- * Schema: DB_SDS/MLD 
-- ********************************************* 


-- Database Section
-- ________________ 

create database DB_SDS;
use DB_SDS;


-- Tables Section
-- _____________ 

create table ABONNEMENT (
     idUtilisateur int not null,
     etatPaiement char not null,
     dateDebut date not null,
     dateFin date not null,
     dateDebutSuspension date not null,
     dateFinSuspension date not null,
     constraint FKSouscrit_ID primary key (idUtilisateur));

create table ARTICLE (
     idArticle int not null auto_increment,
     dateArticle date not null,
     titre varchar(50) not null,
     imageArticle varchar(255) not null,
     texteHtml text not null,
     idUtilisateur int not null,
     idCategorie int not null,
     constraint ID_ARTICLE_ID primary key (idArticle));

create table CATEGORIE (
     idCategorie int not null auto_increment,
     titre varchar(50) not null,
     constraint ID_CATEGORIE_ID primary key (idCategorie));

create table COMMENTAIRE (
     texteCommentaire text not null,
     dateCommentaire date not null,
     idUtilisateur int not null);

create table COMMENTAIRE_SALLE (
     idUtilisateur int not null,
     texteCommentaireSalle text not null,
     dateCommentaireSalle date not null,
     constraint FKA_commente_ID primary key (idUtilisateur));

create table NEWSLETTER (
     mail varchar(255) not null,
     prenom varchar(255) not null,
     nom varchar(255) not null,
     genre char(1) not null,
     constraint ID_NEWSLETTER_ID primary key (mail));

create table NOTE (
     note int not null,
     idArticle int not null,
     idUtilisateur int not null);

create table UTILISATEUR (
     idUtilisateur int not null auto_increment,
     typeUtilisateur int not null,
     mailUtilisateur varchar(255) not null,
     pseudo varchar(255) not null,
     motDePasse varchar(255) not null,
     constraint ID_UTILISATEUR_ID primary key (idUtilisateur));


-- Constraints Section
-- ___________________ 

alter table ABONNEMENT add constraint FKSouscrit_FK
     foreign key (idUtilisateur)
     references UTILISATEUR (idUtilisateur);

alter table ARTICLE add constraint FKRediger_FK
     foreign key (idUtilisateur)
     references UTILISATEUR (idUtilisateur);

alter table ARTICLE add constraint FKAppartient_FK
     foreign key (idCategorie)
     references CATEGORIE (idCategorie);

alter table COMMENTAIRE add constraint FKPoster_FK
     foreign key (idUtilisateur)
     references UTILISATEUR (idUtilisateur);

alter table COMMENTAIRE_SALLE add constraint FKA_commente_FK
     foreign key (idUtilisateur)
     references UTILISATEUR (idUtilisateur);

alter table NOTE add constraint FKEst_evalue_FK
     foreign key (idArticle)
     references ARTICLE (idArticle);

alter table NOTE add constraint FKDonne_FK
     foreign key (idUtilisateur)
     references UTILISATEUR (idUtilisateur);


-- Index Section
-- _____________ 

create unique index FKSouscrit_IND
     on ABONNEMENT (idUtilisateur);

create unique index ID_ARTICLE_IND
     on ARTICLE (idArticle);

create index FKRediger_IND
     on ARTICLE (idUtilisateur);

create index FKAppartient_IND
     on ARTICLE (idCategorie);

create unique index ID_CATEGORIE_IND
     on CATEGORIE (idCategorie);

create index FKPoster_IND
     on COMMENTAIRE (idUtilisateur);

create unique index FKA_commente_IND
     on COMMENTAIRE_SALLE (idUtilisateur);

create unique index ID_NEWSLETTER_IND
     on NEWSLETTER (mail);

create index FKEst_evalue_IND
     on NOTE (idArticle);

create index FKDonne_IND
     on NOTE (idUtilisateur);

create unique index ID_UTILISATEUR_IND
     on UTILISATEUR (idUtilisateur);

