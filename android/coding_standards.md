# Android Coding Standards 

1. ��Ա������ m ��ͷ����ʾ��Ա���� member
2. ������ֻҪ�� static final �ģ��ͱ���ȫ��д��ֻҪ���� static final �ģ����벻��ȫ��д
3. һ�� View �ĳ�Ա�����ڱ�������������һ�� View / Layout / Bar 

  ���� mNameView , mLogoView , mPatientInfoLayout �� mStatusBar������ mNameView �� mName ���������ֿ���

4. �� private �Ĳ�Ҫ public ���������Ʒ���Ȩ��
5. Context��Activity ǧ��ǧ��Ҫ static
6. �ڸ���������Ա��������������ʱ�򣬾�����Ҫ���� new ��

  ������д��һ�����ݿ��ѯ�ķ��� query() , һ��ʱ����ع�������д��һ�������õķ��� newQuery() ��Ϊ�������ϵ� query �������һ�� new ������� N ��֮����������һ�������õķ�����������˼д�� newNewQuery() ��������������� superQuery() �������¼���ĳ�Ա��֪����ʷ��һ�������µĸ��ﲻ���µģ�����֮�󻹰�һ�ٳ��
