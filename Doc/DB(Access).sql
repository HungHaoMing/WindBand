/*
102/11/09	刪除Member中Mode，改用新表格Group代替其功能
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
102/11/28	增加Sheet，管理小號部譜
102/12/01	Table Segment新增欄位order表示排序！
102/12/02	修改ClubPracticeItem,primary key 改為 PracticeDay
102/12/02	修改MemberAttendPractice,primary key 改為MemberID,PracticeDay
102/12/02	修改MemberClubPractice,primary key 改為MemberID,PracticeDay
102/12/02	MemberClubPractice 增加欄位Attend
*/
create database WindClubDB;

use WindClubDB;

create table Member(
	MemberID varchar(20) not null unique,
	Account varchar(100) not null unique,
	Passwd varchar(100) not null,
	Name varchar(50) not null,
	Gender varchar(10) not null,
	CellPhone varchar(20) not null,
	BirthDay Date not null,
	Address varchar(200) not null,
	Email varchar(100) not null,
	Department varchar(200) not null,
	Description note,
	Since date not null,
	Mode int not null,
	primary key(MemberID)
)

create table ChangePassLog(
	CID autoincrement,
	MemberID varchar(20) not null,
	IP varchar(15) not null,
	TheTime date not null,
	OldPasswd varchar(100) not null,
	primary key(CID),
	foreign key(MemberID) references Member
)

create table Segment(
	SID autoincrement,
	CName varchar(50) not null,
	Description note not null,
	primary key(SID)
)

create table Belong(
	MemberID varchar(20) not null,
	SID int not null,
	Year int not null,
	primary key(MemberID,SID,Year),
	foreign key(SID) references Segment,
	foreign key(MemberID) references Member
)

create table Instrument(
	IID autoincrement,
	CName varchar(40) not null,
	EName varchar(40) not null,
	Description note not null,
	TheMemo note,
	SID int not null,
	primary key(IID),
	foreign key(SID) references Segment
)

create table PracticeLog(
	PTID autoincrement,
	MemberID varchar(20) not null,
	SID int not null,
	Place varchar(50) not null,
	Content note not null,
	primary key(PTID),
	foreign key(MemberID) references Member,
	foreign key(SID) references Segment
)

create table MemberPracticeLog(
	MPID autoincrement,
	MemberID varchar(20) not null,
	PTID int not null,
	primary key(MPID),
	foreign key(MemberID) references Member,
	foreign key(PTID) references PracticeLog
)

create table Position(
	PID autoincrement,
	CName varchar(50) not null,
	Jobs note not null,
	primary key(PID)
)

create table PBelong(
	MemberID varchar(20) not null,
	PID int not null,
	Year int not null,
	primary key(MemberID,PID,Year),
	foreign key(MemberID) references Member,
	foreign key(PID) references Position
)

create table PracticeTimeLog(
	SID int not null,
	Place varchar(50) not null,
	PracticeTime date not null,
	Year int not null,
	primary key(SID,Year),
	foreign key(SID) references Segment
)


create table Group(
	GID int not null,
	Name varchar(20) not null,
	Description note,
	primary key(GID)
	/*
	0--管理員
	3--幹部
	5--社員
	10--會員
	*/
)

create table Mode(
	MID autoincrement,
	MemberID varchar(20) not null,
	GID int not null,
	Enable YesNo not null,
	primary key(MID),
	foreign key(MemberID) references Member,
	foreign key(GID) references Group
)

create table History(
	HID autoincrement,
	MemberID varchar(20) not null,
	ChangeTime date not null,
	Description note not null,
	primary key(HID),
	foreign key(MemberID) references Member,
)

create table Announcement(
	AID autoincrement,
	MemberID varchar(20) not null,
	StartDay date not null,
	EndDay date not null,
	Content note not null,
	Title varchar(200) not null,
	Contact varchar(200) not null,
	CID	int not null,
	primary key(AID),
	foreign key(MemberID) references Member
	foreign key(CID) references Class
)

create table Class(
	CID autoincrement,
	Name varchar(20) not null
	primary key(CID)
	/*
	0--公告
	1--活動分享	
	20--其他
	*/
)

create table ClubPracticeItem(
	MemberID varchar(20) not null,
	NoticeDay Date not null,
	PracticeDay Date not null,
	Plase varchar(20) not null,
	PracticeContent	note null,
	Announcement note null,
	Primary key(PracticeDay),
	foreign key(MemberID) references Member
)

create table MemberClubPractice(
	MemberID varchar(20) not null,
	PracticeDay Date not null,
	Primary Key(MemberID,PracticeDay),
	foreign key(PracticeDay) references ClubPracticeItem,
	foreign key(MemberID) references Member
)

create table MemberAttendPractice(
	MemberID varchar(20) not null,
	PracticeDay Date not null,
	Attend YesNo not null,
	Why varchar(150) null,
	Primary Key(MemberID,PracticeDay),
	foreign key(PracticeDay) references ClubPracticeItem,
	foreign key(MemberID) references Member
)

create table Sheet(
	SID autoincrement,
	filename varchar(150) not null;
	AName varchar(150) not null,
	CName varchar(150) null,
	Part varchar(30) null,
	description note null,
	primary key(SID)
)