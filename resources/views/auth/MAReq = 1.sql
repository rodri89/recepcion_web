declare @datetime datetime = getdate();

EXEC DUI_Avail @AvailID = '15A01745-6DF5-E711-8175-020165574D09', @ParentAvailID = NULL, @OrderTypeID = NULL, @AutoOrder = 0, @DistributorOrganizationID = NULL, @RightsLineAvailID = NULL, @ContentOwnerOrganizationID = '962E84C2-3ECD-4922-B80B-CB6117BCBB73', @ContractingEntityOrganizationID = '962E84C2-3ECD-4922-B80B-CB6117BCBB73', @AvailProviderOrganizationID = '310E2270-9533-43CE-8032-D3B3C4FE9991', @AvailLevelTypeID = 'E0CE9AEC-2302-47C1-BE79-2A9D551ABD3F', @AlphaID = 'ABEDB874-DFF4-E711-8175-020165574D09', @TitleID = NULL, @ApplyToLevel = NULL, @TMSID = NULL, @StartDate = 'Feb 22 2018 11:00PM', @EndDate = NULL, @LanguageTypeID = NULL, @TerritoryTypeID = NULL, @RequestItemID = NULL, @MARequestItemID = NULL, @MARequiredStatus = 1, @RetryCount = NULL, @RetryMax = NULL, @PriceValue = NULL, @CurrencyTypeID = NULL, @PurchaseTypeID = NULL, @ResolutionFormatTypeID = NULL, @LicenseTypeID = NULL, @Description = NULL, @SeasonOrEpisodeNumber = NULL, @OriginalAirDate = NULL, @PhysicalReleaseDate = NULL, @PreOrderDate = NULL, @RunTimeMilliseconds = NULL, @BundleOnly = NULL, @PriceTypeID = NULL, @AvailStatusTypeID = '82835442-D72D-40F6-BA4B-21255443BA9B', @AvailWorkflowStatusTypeID = 'D621881D-977A-4599-AC65-62984382F572', @MetadataRedelivery = 0, @Reason = NULL, @DeviceTypeID = NULL, @SubscriptionTypeID = NULL, @LocalizationTypeID = '35DBA04C-124E-415C-B2C8-163B70B3F13A', @StoreLanguageTypeID = NULL, @CaptionExemptionTypeID = NULL, @DueDate = 'Feb 20 2018 11:00PM', @CategoryTypeID = 'F8F9EDC3-9950-4D2D-9C89-4914688EF093', @RequiresCC = NULL, @AllowSinglePassMA = 0, @NonBillable = NULL, @NonBillableReasonTypeID = NULL, @RedeliveryReasonTypeID = NULL, @ScheduledByID = NULL, @RequiresCCUserSelected = NULL, @IsActive = 1, @EditUserAccountID = 'cab5cbfa-8510-e611-80c5-0017a4776c06', @EditDateTime = @datetime;

