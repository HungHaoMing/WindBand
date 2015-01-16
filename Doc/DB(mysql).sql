create database WindClubDB;

use WindClubDB;


use WindClubDB;

create table Member(
	MemberID varchar(20) not null unique, /*身分證字號*/
	Account varchar(100) not null unique,
	Passwd varchar(100) not null,
	Name varchar(50) not null,
	Gender varchar(10) not null check(Gender IN('M','F')),
	CellPhone varchar(20) not null,
	BirthDay Date not null,
	Address varchar(200) not null,
	Email varchar(100) not null,
	Department varchar(200) not null,
	Play varchar(20) not null,
	Since Datetime not null,
	Mode int not null, /*0 super user,1 社員,2 非社員*/
	primary key(MemberID)
);

create table ChangePassLog(
	CID int not null auto_increment,
	MemberID varchar(20) not null,
	IP varchar(15) not null,
	Time Datetime not null,
	OldPasswd varchar(100) not null,
	primary key(CID),
	foreign key(MemberID) references Member(MemberID)
);

create table Segment(
	SID int not null auto_increment,
	CName varchar(50) not null,
	Description text not null,
	primary key(SID)
);

create table Belong(
	BID int not null auto_increment,
	MemberID varchar(20) not null,
	SID int not null,
	Year int not null,
	primary key(BID),
	foreign key(SID) references Segment(SID),
	foreign key(MemberID) references Member(MemberID)
);

create table Instrument(
	IID int not null auto_increment,
	CName varchar(40) not null,
	EName varchar(40) not null,
	Description text not null,
	Memo Text,
	SID int not null,
	primary key(IID),
	foreign key(SID) references Segment(SID)
);

create table PracticeLog(
	PTID int not null auto_increment,
	MemberID varchar(20) not null,
	SID int not null,
	Place varchar(50) not null,
	Content text not null,
	primary key(PTID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(SID) references Segment(SID)
);

create table MemberPracticeLog(
	MPID int not null auto_increment,
	MemberID varchar(20) not null,
	PTID int not null,
	primary key(MPID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(PTID) references PracticeLog(PTID)
);

create table Position(
	PID int not null auto_increment,
	CName varchar(50) not null,
	Jobs text not null,
	primary key(PID)
);

create table PBelong(
	PBID int not null auto_increment,
	MemberID varchar(20) not null,
	PID int not null,
	Year int not null,
	primary key(PBID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(PID) references Position(PID)
);

create table PracticeTimeLog(
	PTID int not null auto_increment,
	SID int not null,
	Place varchar(50) not null,
	PracticeTime datetime not null,
	Year int not null,
	primary key(PTID),
	foreign key(SID) references Segment(SID)
);



