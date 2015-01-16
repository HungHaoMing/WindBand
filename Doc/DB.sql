/*
102/11/09	刪除Member中Mode，改用新表格Group代替其功能
102/11/09	加入Gorub,Mode兩個Table
*/
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
)

create table ChangePassLog(
	CID int not null identityz,
	MemberID varchar(20) not null,
	IP varchar(15) not null,
	Time Datetime not null,
	OldPasswd varchar(100) not null,
	primary key(CID),
	foreign key(MemberID) references Member
)

create table Segment(
	SID int not null identity,
	CName varchar(50) not null,
	Description text not null,
	primary key(SID)
)

create table Belong(
	BID int not null identity,
	MemberID varchar(20) not null,
	SID int not null,
	Year int not null,
	primary key(BID),
	foreign key(SID) references Segment,
	foreign key(MemberID) references Member
)

create table Instrument(
	IID int not null identity,
	CName varchar(40) not null,
	EName varchar(40) not null,
	Description text not null,
	Memo Text,
	SID int not null,
	primary key(IID),
	foreign key(SID) references Segment
)

create table PracticeLog(
	PTID int not null identity,
	MemberID varchar(20) not null,
	SID int not null,
	Place varchar(50) not null,
	Content text not null,
	primary key(PTID),
	foreign key(MemberID) references Member,
	foreign key(SID) references Segment
)

create table MemberPracticeLog(
	MPID int not null identity,
	MemberID varchar(20) not null,
	PTID int not null,
	primary key(MPID),
	foreign key(MemberID) references Member,
	foreign key(PTID) references PracticeLog
)

create table Position(
	PID int not null identity,
	CName varchar(50) not null,
	Jobs text not null,
	primary key(PID)
)

create table PBelong(
	PBID int not null identity,
	MemberID varchar(20) not null,
	PID int not null,
	Year int not null,
	primary key(PBID),
	foreign key(MemberID) references Member,
	foreign key(PID) references Position
)

create table PracticeTimeLog(
	PTID int not null identity,
	SID int not null,
	Place varchar(50) not null,
	PracticeTime datetime not null,
	Year int not null,
	primary key(PTID),
	foreign key(SID) references Segment
)

create table Group(
	GID autoincrement,
	Description text,
	primary key(GID)
)

create table Mode(
	MID autoincrement,
	MemberID varchar(20) not null,
	GID int not null,
	Enable boolean default 'ture' not null,
	foreign key(MemberID) references Member,
	foreign key(GID) references Group
)



