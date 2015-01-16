/*
102/11/09	刪除Member中Mode，改用新表格ClubGroup代替其功能
102/11/09	加入Gorub,Mode兩個Table
102/11/11	增加History的表格，用以儲存社團歷史的資訊
102/11/11	Mode表格設定primary key
102/11/12	刪除Member中Play資訊，直接由Segment代替
102/11/12	增加Member中Description資訊
102/11/14	增加公告table(announcement)
102/11/23	Table Announcement刪除TheDate，增加StartDay,EndDay
102/11/23	Table Announcement刪除Class，增加CID
102/11/23	增加Table Class，用以儲存公告類別
102/11/23	增加CID foreign kye referencr to Class(Table)
102/11/23	PracticeTimeLog 的 primary key 改為(SID,Year)
102/11/23	Belong key 改為(MemberID,Year,SID)
102/11/23	PBelong key 改為(MemberID,PID,Year)
102/11/23	增加MemberClubPractice,ClubPracticeItem,MemberAttendPractice 三個Table，分別儲存團練紀錄(前兩個)、團練出席文
*/
create database WindClubDB;
go
use WindClubDB;

create table Member(
	MemberID varchar(20) not null unique,
	Account varchar(100) not null unique,
	Passwd varchar(100) not null,
	Name varchar(50) not null,
	Gender varchar(10) not null,
	CellPhone varchar(20) not null,
	BirthDay datetime not null,
	Address varchar(200) not null,
	Email varchar(100) not null,
	Department varchar(200) not null,
	Description text,
	Since datetime not null,
	Mode int not null,
	primary key(MemberID)
)

create table ChangePassLog(
	CID int not null identity,
	MemberID varchar(20) not null,
	IP varchar(15) not null,
	TheTime datetime not null,
	OldPasswd varchar(100) not null,
	primary key(CID),
	foreign key(MemberID) references Member(MemberID)
)

create table Segment(
	SID int not null identity,
	CName varchar(50) not null,
	Description text not null,
	primary key(SID)
)

create table Belong(
	MemberID varchar(20) not null,
	SID int not null,
	Year int not null,
	primary key(MemberID,SID,Year),
	foreign key(SID) references Segment(SID),
	foreign key(MemberID) references Member(MemberID)
)

create table Instrument(
	IID int not null identity,
	CName varchar(40) not null,
	EName varchar(40) not null,
	Description text not null,
	TheMemo text,
	SID int not null,
	primary key(IID),
	foreign key(SID) references Segment(SID)
)

create table PracticeLog(
	PTID int not null identity,
	MemberID varchar(20) not null,
	SID int not null,
	Place varchar(50) not null,
	Content text not null,
	primary key(PTID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(SID) references Segment(SID)
)

create table MemberPracticeLog(
	MPID int not null identity,
	MemberID varchar(20) not null,
	PTID int not null,
	primary key(MPID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(PTID) references PracticeLog(PTID)
)

create table Position(
	PID int not null identity,
	CName varchar(50) not null,
	Jobs text not null,
	primary key(PID)
)

create table PBelong(
	MemberID varchar(20) not null,
	PID int not null,
	Year int not null,
	primary key(MemberID,PID,Year),
	foreign key(MemberID) references Member(MemberID),
	foreign key(PID) references Position(PID)
)

create table PracticeTimeLog(
	SID int not null,
	Place varchar(50) not null,
	PracticeTime datetime not null,
	Year int not null,
	primary key(SID,Year),
	foreign key(SID) references Segment(SID)
)


create table ClubGroup(
	GID int not null,
	Name varchar(20) not null,
	Description text,
	primary key(GID)
	/*
	0--管理員
	3--幹部
	5--社員
	10--會員
	*/
)

create table Mode(
	MID int not null identity,
	MemberID varchar(20) not null,
	GID int not null,
	Enable bit not null,
	primary key(MID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(GID) references ClubGroup(GID)
)

create table History(
	HID int not null identity,
	MemberID varchar(20) not null,
	ChangeTime datetime not null,
	Description text not null,
	primary key(HID),
	foreign key(MemberID) references Member(MemberID),
)
create table Class(
	CID int not null identity,
	Name varchar(20) not null
	primary key(CID)
	/*
	0--公告
	1--活動分享	
	20--其他
	*/
)
create table Announcement(
	AID int not null identity,
	MemberID varchar(20) not null,
	StartDay datetime not null,
	EndDay datetime not null,
	Content text not null,
	Title varchar(200) not null,
	Contact varchar(200) not null,
	CID	int not null,
	primary key(AID),
	foreign key(MemberID) references Member(MemberID),
	foreign key(CID) references Class(CID)
)


create table ClubPracticeItem(
	CPID int not null identity,
	MemberID varchar(20) not null,
	NoticeDay datetime not null,
	PracticeDay datetime not null,
	Plase varchar(20) not null,
	PracticeContent	text null,
	Announcement text null,
	Primary key(CPID),
	foreign key(MemberID) references Member(MemberID)
)

create table MemberClubPractice(
	MCID int not null identity,
	MemberID varchar(20) not null,
	CPID int not null,
	Primary Key(MCID),
	foreign key(CPID) references ClubPracticeItem(CPID),
	foreign key(MemberID) references Member(MemberID)
)

create table MemberAttendPractice(
	MAID int not null identity,
	MemberID varchar(20) not null,
	CPID int not null,
	Attend bit not null,
	Why varchar(150) null,
	Primary Key(MAID),
	foreign key(CPID) references ClubPracticeItem(CPID),
	foreign key(MemberID) references Member(MemberID)
)
