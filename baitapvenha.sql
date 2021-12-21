--bai3c--
alter proc spDiemLop @MALOP char(8)
as
begin
select*from SINHVIEN left join DIEM on DIEM.MASV=SINHVIEN.MASV 
where SINHVIEN.MALOP=@MALOP
end
exec spDiemLop'MMT2'
--bai4a--
go
create proc spSoNguyenTo(@n int)
as 
begin
declare @i int
declare @j int
declare @SNT int
set @SNT=1
set @i=2
set @j=2
while(@i<=@n)
begin
    while(@j<=@n)
    begin
        if((@i<>@j) and (@i%@j=0))
        begin
            set @SNT=0
            break
        end
        else
        begin
            set @j=@j+1
        end
    end
    if(@SNT=1)
    begin
        SELECT @i
    end
    set @SNT=1
    set @i=@i+1
    set @j=2
end
end
exec spSoNguyenTo 20
--bai4b--
go
alter proc spTenMon
@mmh char(8)
as
begin
	if exists(select MAMH from  MONHOC where @mmh=MAMH)
		begin
			select TENMH from  MONHOC where @mmh=MAMH
		end
	else print 'Khong ton tai mon hoc co ma' +@mmh
end
go
exec spTenMon'MAV'
go
alter proc spTenMon1
@mmh char(8)
as
begin
	select MAMH,
	(case
		when MAMH=@mmh then TENMH
		else  'khong dung ma '+@mmh
	 end
	 )as 'TenMH'  
	from MONHOC
end
exec spTenMon1'ML'

